<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

$database = new Database();
$db = $database->getConnection();

try {
    // Get total tokens count
    $query = "SELECT COUNT(*) as total_tokens FROM tokens";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $total = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // Get tokens by category
    $query = "SELECT category, COUNT(*) as count FROM tokens GROUP BY category";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $byCategory = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Get last update time
    $query = "SELECT MAX(updated_at) as last_updated FROM tokens";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $lastUpdated = $stmt->fetch(PDO::FETCH_ASSOC);
    
    echo json_encode([
        "success" => true,
        "stats" => [
            "total_tokens" => $total['total_tokens'],
            "by_category" => $byCategory,
            "last_updated" => $lastUpdated['last_updated']
        ]
    ]);
    
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
        "success" => false,
        "message" => "Database error: " . $e->getMessage()
    ]);
}
?>