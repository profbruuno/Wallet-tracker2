<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

$database = new Database();
$db = $database->getConnection();

$category = isset($_GET['category']) ? $_GET['category'] : 'all';

try {
    if ($category === 'all') {
        $query = "SELECT * FROM tokens ORDER BY updated_at DESC";
        $stmt = $db->prepare($query);
    } else {
        $query = "SELECT * FROM tokens WHERE category = :category ORDER BY updated_at DESC";
        $stmt = $db->prepare($query);
        $stmt->bindParam(":category", $category);
    }
    
    $stmt->execute();
    $tokens = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode([
        "success" => true,
        "count" => count($tokens),
        "tokens" => $tokens
    ]);
    
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
        "success" => false,
        "message" => "Database error: " . $e->getMessage()
    ]);
}
?>