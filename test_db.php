<?php
header('Content-Type: text/html; charset=UTF-8');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Database Connection Test</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .success { color: green; font-weight: bold; }
        .error { color: red; font-weight: bold; }
        .info { background: #f0f0f0; padding: 10px; margin: 10px 0; }
    </style>
</head>
<body>
    <h1>Database Connection Test</h1>
    
    <?php
    echo "<div class='info'>";
    echo "<strong>Test started at:</strong> " . date('Y-m-d H:i:s') . "<br>";
    echo "<strong>PHP Version:</strong> " . phpversion() . "<br>";
    echo "</div>";

    // Test database connection
    echo "<h2>1. Testing Database Connection</h2>";
    
    $host = "sql102.infinityfree.com";
    $db_name = "if0_39847940_Memestake";
    $username = "if0_39847940";
    $password = "227733";
    
    try {
        $conn = new PDO("mysql:host=$host;dbname=$db_name", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "<p class='success'>✓ Database connection successful!</p>";
        
        // Test if tables exist
        echo "<h2>2. Checking Required Tables</h2>";
        $tables = ['users', 'portfolio_users', 'tokens', 'portfolio_holdings'];
        
        foreach ($tables as $table) {
            $result = $conn->query("SHOW TABLES LIKE '$table'");
            if ($result->rowCount() > 0) {
                echo "<p class='success'>✓ Table '$table' exists</p>";
            } else {
                echo "<p class='error'>✗ Table '$table' is missing</p>";
            }
        }
        
        // Test config.php
        echo "<h2>3. Testing config.php</h2>";
        if (file_exists('config.php')) {
            echo "<p class='success'>✓ config.php file exists</p>";
            
            include 'config.php';
            $database = new Database();
            $test_conn = $database->getConnection();
            
            if ($test_conn) {
                echo "<p class='success'>✓ Database class works correctly</p>";
            } else {
                echo "<p class='error'>✗ Database class failed</p>";
            }
        } else {
            echo "<p class='error'>✗ config.php file not found</p>";
        }
        
        // Test auth.php
        echo "<h2>4. Testing auth.php endpoints</h2>";
        echo "<p>Testing authentication endpoints...</p>";
        
        // Test if we can access auth.php
        $auth_url = './auth.php?action=check';
        $context = stream_context_create([
            'http' => [
                'method' => 'GET',
                'ignore_errors' => true
            ]
        ]);
        
        $response = file_get_contents($auth_url, false, $context);
        if ($response !== false) {
            echo "<p class='success'>✓ auth.php is accessible</p>";
            $data = json_decode($response, true);
            if (json_last_error() === JSON_ERROR_NONE) {
                echo "<p class='success'>✓ auth.php returns valid JSON</p>";
                echo "<pre>Response: " . print_r($data, true) . "</pre>";
            } else {
                echo "<p class='error'>✗ auth.php returns invalid JSON</p>";
            }
        } else {
            echo "<p class='error'>✗ Cannot access auth.php</p>";
        }
        
    } catch (PDOException $e) {
        echo "<p class='error'>✗ Database connection failed: " . $e->getMessage() . "</p>";
        echo "<div class='info'>";
        echo "<strong>Connection details used:</strong><br>";
        echo "Host: $host<br>";
        echo "Database: $db_name<br>";
        echo "Username: $username<br>";
        echo "Password: " . str_repeat('*', strlen($password)) . "<br>";
        echo "</div>";
    }

    // Test file permissions
    echo "<h2>5. File Permissions Check</h2>";
    $files_to_check = [
        'config.php',
        'auth.php', 
        'store_portfolio.php',
        'get_portfolio.php',
        'test_db.php'
    ];
    
    foreach ($files_to_check as $file) {
        if (file_exists($file)) {
            $perms = substr(sprintf('%o', fileperms($file)), -4);
            echo "<p>✓ $file exists (Permissions: $perms)</p>";
        } else {
            echo "<p class='error'>✗ $file not found</p>";
        }
    }

    // Test PHP extensions
    echo "<h2>6. PHP Extensions Check</h2>";
    $extensions = ['pdo', 'pdo_mysql', 'json', 'session'];
    foreach ($extensions as $ext) {
        if (extension_loaded($ext)) {
            echo "<p class='success'>✓ $ext extension loaded</p>";
        } else {
            echo "<p class='error'>✗ $ext extension not loaded</p>";
        }
    }
    ?>

    <h2>7. Quick Fix - Create Missing Tables</h2>
    <form method="post">
        <input type="submit" name="create_tables" value="Create Missing Tables">
    </form>

    <?php
    if (isset($_POST['create_tables'])) {
        echo "<h3>Creating tables...</h3>";
        
        try {
            $conn = new PDO("mysql:host=$host;dbname=$db_name", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $tables_sql = [
                "users" => "CREATE TABLE IF NOT EXISTS users (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    email VARCHAR(255) UNIQUE NOT NULL,
                    password_hash VARCHAR(255) NOT NULL,
                    username VARCHAR(100) NOT NULL,
                    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                    last_login TIMESTAMP NULL,
                    is_active BOOLEAN DEFAULT TRUE
                )",
                
                "portfolio_users" => "CREATE TABLE IF NOT EXISTS portfolio_users (
                    user_id INT AUTO_INCREMENT PRIMARY KEY,
                    email VARCHAR(255) UNIQUE NOT NULL,
                    username VARCHAR(100) NOT NULL,
                    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                    last_accessed TIMESTAMP NULL,
                    last_login TIMESTAMP NULL
                )",
                
                "tokens" => "CREATE TABLE IF NOT EXISTS tokens (
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
                
                "portfolio_holdings" => "CREATE TABLE IF NOT EXISTS portfolio_holdings (
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
            
            foreach ($tables_sql as $table_name => $sql) {
                try {
                    $conn->exec($sql);
                    echo "<p class='success'>✓ Table '$table_name' created successfully</p>";
                } catch (PDOException $e) {
                    echo "<p class='error'>✗ Failed to create '$table_name': " . $e->getMessage() . "</p>";
                }
            }
            
        } catch (PDOException $e) {
            echo "<p class='error'>Database error: " . $e->getMessage() . "</p>";
        }
    }
    ?>

    <h2>8. Test Authentication</h2>
    <form method="post">
        <h3>Test Registration</h3>
        <input type="text" name="test_username" placeholder="Username" value="testuser">
        <input type="email" name="test_email" placeholder="Email" value="test@example.com">
        <input type="password" name="test_password" placeholder="Password" value="123456">
        <input type="submit" name="test_register" value="Test Registration">
    </form>

    <?php
    if (isset($_POST['test_register'])) {
        echo "<h3>Registration Test Result:</h3>";
        
        $test_data = [
            'email' => $_POST['test_email'],
            'password' => $_POST['test_password'],
            'username' => $_POST['test_username']
        ];
        
        $context = stream_context_create([
            'http' => [
                'method' => 'POST',
                'header' => 'Content-Type: application/json',
                'content' => json_encode($test_data)
            ]
        ]);
        
        $response = file_get_contents('./auth.php?action=register', false, $context);
        
        if ($response !== false) {
            $data = json_decode($response, true);
            echo "<pre>" . print_r($data, true) . "</pre>";
        } else {
            echo "<p class='error'>Failed to call auth.php</p>";
        }
    }
    ?>

    <hr>
    <p><strong>Next Steps:</strong></p>
    <ol>
        <li>Run this test file to see where the issue is</li>
        <li>If tables are missing, click "Create Missing Tables"</li>
        <li>Test registration to see if auth.php works</li>
        <li>Check the error messages above to fix specific issues</li>
    </ol>
</body>
</html>