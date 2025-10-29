<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/php_errors.log');

include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $database = new Database();
        $db = $database->getConnection();

        $email = trim($_POST['email'] ?? '');
        $password = trim($_POST['password'] ?? '');
        $username = trim($_POST['username'] ?? '');
        $confirm_password = trim($_POST['confirm_password'] ?? '');

        error_log("Form registration - Email: $email, Username: $username");

        // Validate input
        if (empty($email) || empty($password) || empty($username) || empty($confirm_password)) {
            header('Location: index.php?register_error=All fields are required');
            exit;
        }

        if ($password !== $confirm_password) {
            header('Location: index.php?register_error=Passwords do not match');
            exit;
        }

        if (strlen($password) < 6) {
            header('Location: index.php?register_error=Password must be at least 6 characters');
            exit;
        }

        if (strlen($username) < 3 || strlen($username) > 50) {
            header('Location: index.php?register_error=Username must be between 3 and 50 characters');
            exit;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header('Location: index.php?register_error=Invalid email format');
            exit;
        }

        // Check if user exists
        $check = $db->prepare("SELECT id, email, username FROM users WHERE email = ? OR username = ?");
        $check->execute([$email, $username]);
        
        if ($check->rowCount() > 0) {
            $existing = $check->fetch(PDO::FETCH_ASSOC);
            if ($existing['email'] === $email) {
                header('Location: index.php?register_error=Email already registered');
            } else {
                header('Location: index.php?register_error=Username already taken');
            }
            exit;
        }

        // Insert user
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $insert = $db->prepare("INSERT INTO users (email, username, password_hash, last_login) VALUES (?, ?, ?, NOW())");
        
        if ($insert->execute([$email, $username, $password_hash])) {
            $user_id = $db->lastInsertId();
            
            // Start session
            session_start();
            session_regenerate_id(true);
            
            $_SESSION['user_id'] = $user_id;
            $_SESSION['user_email'] = $email;
            $_SESSION['username'] = $username;
            $_SESSION['logged_in'] = true;
            $_SESSION['login_time'] = time();
            
            header('Location: index.php?register_success=Registration successful! Welcome to TikStake.');
            exit;
        } else {
            throw new Exception("Database insertion failed");
        }
    } catch (Exception $e) {
        error_log("Registration error: " . $e->getMessage());
        header('Location: index.php?register_error=Registration failed. Please try again.');
        exit;
    }
} else {
    header('Location: index.php');
    exit;
}
?>