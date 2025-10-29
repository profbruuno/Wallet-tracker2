<?php
// Enable detailed error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/auth_errors.log');

// Headers for CORS
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

// Log the request for debugging
error_log("Auth request: " . $_SERVER['REQUEST_METHOD'] . " " . ($_GET['action'] ?? 'no action'));

try {
    // Include config
    if (!file_exists('config.php')) {
        throw new Exception('Configuration file missing');
    }
    
    include 'config.php';

    $database = new Database();
    $db = $database->getConnection();

    $action = $_GET['action'] ?? '';

    error_log("Processing action: " . $action);

    switch ($action) {
        case 'register':
            registerUser($db);
            break;
            
        case 'login':
            loginUser($db);
            break;
            
        case 'logout':
            logoutUser();
            break;
            
        case 'check':
            checkAuth();
            break;
            
        default:
            http_response_code(400);
            echo json_encode(["success" => false, "message" => "Invalid action"]);
    }
} catch (Exception $e) {
    error_log("Auth system error: " . $e->getMessage());
    http_response_code(500);
    echo json_encode([
        "success" => false, 
        "message" => "Server error: " . $e->getMessage()
    ]);
}

function registerUser($db) {
    error_log("Starting user registration");
    
    // Get JSON input
    $input = json_decode(file_get_contents('php://input'), true);
    if (!$input) {
        $input = $_POST; // Fallback to POST data
    }
    
    if (!$input) {
        http_response_code(400);
        echo json_encode(["success" => false, "message" => "Invalid input format"]);
        return;
    }

    $email = trim($input['email'] ?? '');
    $password = trim($input['password'] ?? '');
    $username = trim($input['username'] ?? '');

    error_log("Registration attempt - Email: $email, Username: $username");

    // Validate input
    if (empty($email) || empty($password) || empty($username)) {
        http_response_code(400);
        echo json_encode(["success" => false, "message" => "All fields are required"]);
        return;
    }

    // Email validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo json_encode(["success" => false, "message" => "Invalid email format"]);
        return;
    }

    if (strlen($password) < 6) {
        http_response_code(400);
        echo json_encode(["success" => false, "message" => "Password must be at least 6 characters"]);
        return;
    }

    if (strlen($username) < 3 || strlen($username) > 50) {
        http_response_code(400);
        echo json_encode(["success" => false, "message" => "Username must be between 3 and 50 characters"]);
        return;
    }

    try {
        // Check if user exists
        $check = $db->prepare("SELECT id FROM users WHERE email = ? OR username = ?");
        $check->execute([$email, $username]);
        
        if ($check->rowCount() > 0) {
            // Check which one exists
            $existing = $db->prepare("SELECT email, username FROM users WHERE email = ? OR username = ?");
            $existing->execute([$email, $username]);
            $existingUser = $existing->fetch(PDO::FETCH_ASSOC);
            
            $message = "Registration failed. ";
            if ($existingUser['email'] === $email) {
                $message .= "Email already registered.";
            } else {
                $message .= "Username already taken.";
            }
            
            http_response_code(409);
            echo json_encode(["success" => false, "message" => $message]);
            return;
        }

        // Insert user
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $insert = $db->prepare("INSERT INTO users (email, username, password_hash, last_login) VALUES (?, ?, ?, NOW())");
        
        if ($insert->execute([$email, $username, $password_hash])) {
            $user_id = $db->lastInsertId();
            
            // Start session securely
            session_start();
            session_regenerate_id(true);
            
            $_SESSION['user_id'] = $user_id;
            $_SESSION['user_email'] = $email;
            $_SESSION['username'] = $username;
            $_SESSION['logged_in'] = true;
            $_SESSION['login_time'] = time();
            
            // Update last login
            $update = $db->prepare("UPDATE users SET last_login = NOW() WHERE id = ?");
            $update->execute([$user_id]);
            
            error_log("User registered successfully: $email");
            
            http_response_code(201);
            echo json_encode([
                "success" => true,
                "message" => "Registration successful! Welcome to TikStake.",
                "user" => [
                    "id" => $user_id, 
                    "email" => $email, 
                    "username" => $username
                ]
            ]);
        } else {
            throw new Exception("Database insertion failed");
        }
    } catch (PDOException $e) {
        error_log("Registration database error: " . $e->getMessage());
        http_response_code(500);
        echo json_encode(["success" => false, "message" => "Registration failed. Please try again."]);
    }
}

function loginUser($db) {
    error_log("Starting user login");
    
    // Get JSON input
    $input = json_decode(file_get_contents('php://input'), true);
    if (!$input) {
        $input = $_POST; // Fallback to POST data
    }
    
    if (!$input) {
        http_response_code(400);
        echo json_encode(["success" => false, "message" => "Invalid input format"]);
        return;
    }

    $email = trim($input['email'] ?? '');
    $password = trim($input['password'] ?? '');

    error_log("Login attempt - Email: $email");

    if (empty($email) || empty($password)) {
        http_response_code(400);
        echo json_encode(["success" => false, "message" => "Email and password required"]);
        return;
    }

    try {
        // Find user
        $user = $db->prepare("SELECT id, email, username, password_hash, is_active FROM users WHERE email = ?");
        $user->execute([$email]);
        
        if ($user->rowCount() === 0) {
            http_response_code(401);
            echo json_encode(["success" => false, "message" => "Invalid email or password"]);
            return;
        }

        $user_data = $user->fetch(PDO::FETCH_ASSOC);
        
        // Check if account is active
        if (!$user_data['is_active']) {
            http_response_code(403);
            echo json_encode(["success" => false, "message" => "Account is deactivated. Please contact support."]);
            return;
        }
        
        if (password_verify($password, $user_data['password_hash'])) {
            // Start session securely
            session_start();
            session_regenerate_id(true);
            
            $_SESSION['user_id'] = $user_data['id'];
            $_SESSION['user_email'] = $user_data['email'];
            $_SESSION['username'] = $user_data['username'];
            $_SESSION['logged_in'] = true;
            $_SESSION['login_time'] = time();
            
            // Update last login
            $update = $db->prepare("UPDATE users SET last_login = NOW() WHERE id = ?");
            $update->execute([$user_data['id']]);
            
            error_log("User logged in successfully: $email");
            
            echo json_encode([
                "success" => true,
                "message" => "Login successful! Welcome back, " . $user_data['username'] . ".",
                "user" => [
                    "id" => $user_data['id'],
                    "email" => $user_data['email'],
                    "username" => $user_data['username']
                ]
            ]);
        } else {
            http_response_code(401);
            echo json_encode(["success" => false, "message" => "Invalid email or password"]);
        }
    } catch (PDOException $e) {
        error_log("Login database error: " . $e->getMessage());
        http_response_code(500);
        echo json_encode(["success" => false, "message" => "Login failed. Please try again."]);
    }
}

function logoutUser() {
    session_start();
    
    // Clear all session variables
    $_SESSION = [];
    
    // Destroy session cookie
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
    
    session_destroy();
    
    echo json_encode(["success" => true, "message" => "Logged out successfully"]);
}

function checkAuth() {
    session_start();
    
    // Debug session
    error_log("Session check: logged_in=" . ($_SESSION['logged_in'] ?? 'false'));
    error_log("Session user_id=" . ($_SESSION['user_id'] ?? 'none'));
    error_log("Session username=" . ($_SESSION['username'] ?? 'none'));
    
    // Check if session is valid (less than 24 hours old)
    $max_session_time = 24 * 60 * 60; // 24 hours
    $session_valid = isset($_SESSION['logged_in']) && 
                    $_SESSION['logged_in'] && 
                    isset($_SESSION['login_time']) && 
                    (time() - $_SESSION['login_time']) < $max_session_time;
    
    if ($session_valid) {
        echo json_encode([
            "success" => true,
            "authenticated" => true,
            "user" => [
                "id" => $_SESSION['user_id'],
                "email" => $_SESSION['user_email'],
                "username" => $_SESSION['username']
            ]
        ]);
    } else {
        // Clear invalid session
        session_destroy();
        echo json_encode([
            "success" => true, 
            "authenticated" => false,
            "message" => "Session expired"
        ]);
    }
}
?>