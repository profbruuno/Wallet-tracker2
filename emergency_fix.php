<?php
header('Content-Type: text/html; charset=UTF-8');
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h1>Emergency Database Fix</h1>";

$host = "sql102.infinityfree.com";
$db_name = "if0_39847940_Memestake";
$username = "if0_39847940";
$password = "227733";

try {
    $conn = new PDO("mysql:host=$host;dbname=$db_name", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "<p style='color: green;'>✓ Database connected</p>";
    
    // Drop and recreate users table with correct structure
    $sql = [
        "DROP TABLE IF EXISTS users_backup",
        "CREATE TABLE users_backup AS SELECT * FROM users",
        "DROP TABLE IF EXISTS users",
        "CREATE TABLE users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            email VARCHAR(255) UNIQUE NOT NULL,
            username VARCHAR(100) NOT NULL,
            password_hash VARCHAR(255) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            last_login TIMESTAMP NULL,
            is_active BOOLEAN DEFAULT TRUE
        )",
        "INSERT INTO users (id, email, username, password_hash, created_at, last_login, is_active) 
         SELECT id, email, COALESCE(username, email), password_hash, created_at, last_login, is_active 
         FROM users_backup",
        "DROP TABLE users_backup"
    ];
    
    foreach ($sql as $query) {
        try {
            $conn->exec($query);
            echo "<p>✓ Executed: " . substr($query, 0, 50) . "...</p>";
        } catch (Exception $e) {
            echo "<p style='color: orange;'>⚠ " . $e->getMessage() . "</p>";
        }
    }
    
    echo "<h2>Testing...</h2>";
    
    // Test insertion
    $test_email = "test_" . time() . "@example.com";
    $test_username = "testuser_" . time();
    $test_password = password_hash("123456", PASSWORD_DEFAULT);
    
    $stmt = $conn->prepare("INSERT INTO users (email, username, password_hash) VALUES (?, ?, ?)");
    
    if ($stmt->execute([$test_email, $test_username, $test_password])) {
        echo "<p style='color: green;'>✓ Test user inserted successfully</p>";
        
        // Clean up
        $conn->exec("DELETE FROM users WHERE email = '$test_email'");
        
        echo "<h2 style='color: green;'>✓ Database fix completed successfully!</h2>";
        echo "<p><a href='index.php'>Go to main application</a></p>";
    } else {
        echo "<p style='color: red;'>✗ Test insertion failed</p>";
    }
    
} catch (PDOException $e) {
    echo "<p style='color: red;'>✗ Database error: " . $e->getMessage() . "</p>";
}
?>