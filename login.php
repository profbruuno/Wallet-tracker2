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

        error_log("Form login - Email: $email");

        if (empty($email) || empty($password)) {
            header('Location: index.php?login_error=Email and password required');
            exit;
        }

        // Find user
        $user = $db->prepare("SELECT id, email, username, password_hash, is_active FROM users WHERE email = ?");
        $user->execute([$email]);
        
        if ($user->rowCount() === 0) {
            header('Location: index.php?login_error=Invalid email or password');
            exit;
        }

        $user_data = $user->fetch(PDO::FETCH_ASSOC);
        
        if (password_verify($password, $user_data['password_hash'])) {
            // Start session
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
            
            header('Location: index.php?login_success=Login successful! Welcome back, ' . $user_data['username'] . '.');
            exit;
        } else {
            header('Location: index.php?login_error=Invalid email or password');
            exit;
        }
    } catch (Exception $e) {
        error_log("Login error: " . $e->getMessage());
        header('Location: index.php?login_error=Login failed. Please try again.');
        exit;
    }
} else {
    header('Location: index.php');
    exit;
}
?>