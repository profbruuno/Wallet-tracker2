<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    http_response_code(401);
    echo json_encode(["success" => false, "message" => "Authentication required"]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(["message" => "Method not allowed"]);
    exit;
}

$input = file_get_contents("php://input");
$data = json_decode($input, true);

if (!$data || !isset($data['holding_id'])) {
    http_response_code(400);
    echo json_encode(["success" => false, "message" => "Holding ID required"]);
    exit;
}

$database = new Database();
$db = $database->getConnection();

$user_id = $_SESSION['user_id'];
$holding_id = $data['holding_id'];

try {
    $verifyQuery = "SELECT id FROM portfolio_holdings WHERE id = :holding_id AND user_id = :user_id";
    $verifyStmt = $db->prepare($verifyQuery);
    $verifyStmt->bindParam(":holding_id", $holding_id);
    $verifyStmt->bindParam(":user_id", $user_id);
    $verifyStmt->execute();
    
    if ($verifyStmt->rowCount() === 0) {
        http_response_code(404);
        echo json_encode(["success" => false, "message" => "Holding not found"]);
        exit;
    }

    $deleteQuery = "DELETE FROM portfolio_holdings WHERE id = :holding_id AND user_id = :user_id";
    $deleteStmt = $db->prepare($deleteQuery);
    $deleteStmt->bindParam(":holding_id", $holding_id);
    $deleteStmt->bindParam(":user_id", $user_id);
    
    if ($deleteStmt->execute()) {
        echo json_encode([
            "success" => true,
            "message" => "Holding removed successfully"
        ]);
    } else {
        throw new Exception("Failed to delete holding");
    }
    
} catch (PDOException $e) {
    error_log("Error removing portfolio item: " . $e->getMessage());
    http_response_code(500);
    echo json_encode([
        "success" => false,
        "message" => "Database error: " . $e->getMessage()
    ]);
}
?>