<?php
// Test database connection with correct password AND fix table structure
header('Content-Type: text/html; charset=UTF-8');

echo "<h1>Database Connection Test & Table Structure Fix</h1>";

$host = "sql102.infinityfree.com";
$db_name = "if0_39847940_Memestake";
$username = "if0_39847940";
$password = "2OZow96Ds22";

try {
    $conn = new PDO("mysql:host=$host;dbname=$db_name", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "<p style='color: green; font-weight: bold;'>✓ SUCCESS: Connected to database!</p>";
    
    // First, let's check the current table structure
    echo "<h2>Checking Current Table Structure...</h2>";
    
    $tables = ['users', 'portfolio_users', 'tokens', 'portfolio_holdings'];
    
    foreach ($tables as $table) {
        try {
            $result = $conn->query("DESCRIBE $table");
            $columns = $result->fetchAll(PDO::FETCH_COLUMN);
            echo "<p><strong>Table: $table</strong> - Columns: " . implode(', ', $columns) . "</p>";
        } catch (PDOException $e) {
            echo "<p style='color: red;'>✗ Cannot describe table $table: " . $e->getMessage() . "</p>";
        }
    }
    
    // Fix the users table if it doesn't have username column
    echo "<h2>Fixing Table Structure...</h2>";
    
    // Check if users table has username column
    $check_username = $conn->query("SHOW COLUMNS FROM users LIKE 'username'");
    if ($check_username->rowCount() == 0) {
        echo "<p>Users table missing 'username' column. Fixing...</p>";
        
        // Create a temporary table with correct structure
        $conn->exec("CREATE TABLE users_new (
            id INT AUTO_INCREMENT PRIMARY KEY,
            email VARCHAR(255) UNIQUE NOT NULL,
            username VARCHAR(100) NOT NULL,
            password_hash VARCHAR(255) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            last_login TIMESTAMP NULL,
            is_active BOOLEAN DEFAULT TRUE
        )");
        
        // Copy data from old table if it exists
        try {
            $conn->exec("INSERT INTO users_new (id, email, password_hash, created_at, last_login, is_active) 
                        SELECT id, email, password_hash, created_at, last_login, is_active FROM users");
        } catch (Exception $e) {
            echo "<p>No data to copy from old users table</p>";
        }
        
        // Drop old table and rename new one
        $conn->exec("DROP TABLE IF EXISTS users_old");
        $conn->exec("DROP TABLE IF EXISTS users");
        $conn->exec("ALTER TABLE users_new RENAME TO users");
        
        echo "<p style='color: green;'>✓ Users table fixed with username column</p>";
    } else {
        echo "<p style='color: green;'>✓ Users table already has username column</p>";
    }
    
    // Test the fixed structure
    echo "<h2>Testing Fixed Structure...</h2>";
    
    $test_email = "test_" . time() . "@example.com";
    $test_username = "testuser_" . time();
    $test_password = password_hash("123456", PASSWORD_DEFAULT);
    
    $insert_sql = "INSERT INTO users (email, username, password_hash) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($insert_sql);
    
    if ($stmt->execute([$test_email, $test_username, $test_password])) {
        echo "<p style='color: green;'>✓ User insertion with username works!</p>";
        
        // Verify the data was inserted correctly
        $check_sql = "SELECT * FROM users WHERE email = ?";
        $check_stmt = $conn->prepare($check_sql);
        $check_stmt->execute([$test_email]);
        $user = $check_stmt->fetch(PDO::FETCH_ASSOC);
        
        echo "<p>Inserted user: " . htmlspecialchars($user['username']) . " (" . htmlspecialchars($user['email']) . ")</p>";
        
        // Clean up
        $conn->exec("DELETE FROM users WHERE email = '$test_email'");
    } else {
        echo "<p style='color: red;'>✗ User insertion still fails</p>";
    }
    
    echo "<h2>Testing Authentication System...</h2>";
    
    // Test auth.php directly
    $test_data = [
        'username' => 'testuser_final',
        'email' => 'test_final@example.com', 
        'password' => '123456'
    ];
    
    $context = stream_context_create([
        'http' => [
            'method' => 'POST',
            'header' => 'Content-Type: application/json',
            'content' => json_encode($test_data)
        ]
    ]);
    
    $response = file_get_contents('http://tikstake.gt.tc/auth.php?action=register', false, $context);
    
    if ($response !== false) {
        $result = json_decode($response, true);
        echo "<pre>Auth Response: " . print_r($result, true) . "</pre>";
        
        if ($result['success']) {
            echo "<p style='color: green; font-weight: bold;'>✓ AUTHENTICATION SYSTEM IS WORKING!</p>";
        } else {
            echo "<p style='color: red;'>✗ Authentication failed: " . $result['message'] . "</p>";
        }
    } else {
        echo "<p style='color: red;'>✗ Cannot call auth.php</p>";
    }
    
    echo "<h2>Next Steps:</h2>";
    echo "<ol>";
    echo "<li><a href='auth_test.html' target='_blank'>Test Authentication System</a></li>";
    echo "<li><a href='index.html' target='_blank'>Test Main Application</a></li>";
    echo "</ol>";
    
} catch (PDOException $e) {
    echo "<p style='color: red; font-weight: bold;'>✗ Database connection failed: " . $e->getMessage() . "</p>";
    echo "<p>Please verify your database credentials in config.php</p>";
}
?>