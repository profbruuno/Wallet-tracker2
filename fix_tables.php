<?php
header('Content-Type: text/html; charset=UTF-8');

echo "<h1>Fixing Database Tables</h1>";

include 'config.php';
$database = new Database();
$conn = $database->getConnection();

if (!$conn) {
    die("Database connection failed");
}

// Drop and recreate tables with correct structure
$tables = [
    "DROP TABLE IF EXISTS portfolio_holdings",
    "DROP TABLE IF EXISTS tokens", 
    "DROP TABLE IF EXISTS portfolio_users",
    "DROP TABLE IF EXISTS users",

    // Recreate users table with username column
    "CREATE TABLE users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        email VARCHAR(255) UNIQUE NOT NULL,
        username VARCHAR(100) NOT NULL,
        password_hash VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        last_login TIMESTAMP NULL,
        is_active BOOLEAN DEFAULT TRUE
    )",

    // Recreate portfolio_users table  
    "CREATE TABLE portfolio_users (
        user_id INT AUTO_INCREMENT PRIMARY KEY,
        email VARCHAR(255) UNIQUE NOT NULL,
        username VARCHAR(100) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        last_accessed TIMESTAMP NULL,
        last_login TIMESTAMP NULL
    )",

    // Recreate tokens table
    "CREATE TABLE tokens (
        id INT AUTO_INCREMENT PRIMARY KEY,
        pair_id VARCHAR(255) UNIQUE NOT NULL,
        name VARCHAR(255) NOT NULL,
        symbol VARCHAR(50) NOT NULL,
        current_price DECIMAL(20,10) NULL,
        volume_24h DECIMAL(20,2) NULL,
        change_24h DECIMAL(10,4) NULL,
        liquidity DECIMAL(20,2) NULL,
        market_cap DECIMAL(20,2) NULL,
        token_address VARCHAR(255) NULL,
        added_date DATE NULL,
        listing_price DECIMAL(20,10) NULL,
        category ENUM('popular', 'new', 'high_risk') NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )",

    // Recreate portfolio_holdings table
    "CREATE TABLE portfolio_holdings (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        pair_id VARCHAR(255) NOT NULL,
        token_name VARCHAR(255) NOT NULL,
        token_symbol VARCHAR(50) NOT NULL,
        amount DECIMAL(20,10) NOT NULL,
        buy_price DECIMAL(20,10) NOT NULL,
        current_price DECIMAL(20,10) NOT NULL,
        added_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )"
];

foreach ($tables as $sql) {
    try {
        $conn->exec($sql);
        echo "<p style='color: green;'>✓ Executed: " . substr($sql, 0, 50) . "...</p>";
    } catch (PDOException $e) {
        echo "<p style='color: red;'>✗ Failed: " . $e->getMessage() . "</p>";
    }
}

// Test the fix
echo "<h2>Testing Fixed Tables...</h2>";

// Test user insertion
$test_email = "test_" . time() . "@example.com";
$test_username = "testuser_" . time();
$test_password = password_hash("123456", PASSWORD_DEFAULT);

$insert_sql = "INSERT INTO users (email, username, password_hash) VALUES (?, ?, ?)";
$stmt = $conn->prepare($insert_sql);

if ($stmt->execute([$test_email, $test_username, $test_password])) {
    echo "<p style='color: green;'>✓ User insertion works with username column</p>";
    
    // Clean up
    $conn->exec("DELETE FROM users WHERE email = '$test_email'");
} else {
    echo "<p style='color: red;'>✗ User insertion still fails</p>";
}

echo "<h2>Next Steps:</h2>";
echo "<p><a href='auth_test.html'>Test Authentication Again</a></p>";
echo "<p><a href='index.html'>Test Main Application</a></p>";
?>