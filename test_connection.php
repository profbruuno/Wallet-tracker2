<?php
// Simple database connection test
header('Content-Type: text/plain');

$host = "sql102.infinityfree.com";
$db_name = "if0_39847940_Memestake";
$username = "if0_39847940";
$password = "227733";

try {
    $conn = new PDO("mysql:host=$host;dbname=$db_name", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "SUCCESS: Connected to database\n";
    
    // Test basic query
    $stmt = $conn->query("SELECT 1 as test");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "SUCCESS: Basic query works\n";
    
} catch (PDOException $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}
?>