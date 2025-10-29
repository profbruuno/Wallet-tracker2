<?php
// Simple debug script to test authentication
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: text/plain');

echo "Testing authentication system...\n";

// Test database connection
include 'config.php';

try {
    $database = new Database();
    $conn = $database->getConnection();
    
    if ($conn) {
        echo "✓ Database connection successful\n";
        
        // Test if users table exists and has correct structure
        $result = $conn->query("SHOW COLUMNS FROM users");
        $columns = $result->fetchAll(PDO::FETCH_COLUMN);
        echo "✓ Users table columns: " . implode(', ', $columns) . "\n";
        
        // Check if username column exists
        if (in_array('username', $columns)) {
            echo "✓ Username column exists\n";
        } else {
            echo "✗ Username column missing - this is the problem!\n";
        }
    } else {
        echo "✗ Database connection failed\n";
    }
} catch (Exception $e) {
    echo "✗ Error: " . $e->getMessage() . "\n";
}

echo "\nTesting auth.php directly:\n";

// Test auth.php
$test_data = [
    'username' => 'testuser_' . time(),
    'email' => 'test_' . time() . '@example.com',
    'password' => '123456'
];

$context = stream_context_create([
    'http' => [
        'method' => 'POST',
        'header' => 'Content-Type: application/json',
        'content' => json_encode($test_data)
    ]
]);

$response = file_get_contents('http://' . $_SERVER['HTTP_HOST'] . '/auth.php?action=register', false, $context);

if ($response === false) {
    echo "✗ Cannot call auth.php - 500 error detected\n";
    $error = error_get_last();
    echo "Error: " . $error['message'] . "\n";
} else {
    echo "✓ Auth.php response: " . $response . "\n";
}
?>