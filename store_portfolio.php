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

error_log("Portfolio save request received");
error_log("User ID: " . ($_SESSION['user_id'] ?? 'none'));

if (!$data || !isset($data['holdings'])) {
    http_response_code(400);
    echo json_encode(["success" => false, "message" => "Invalid data received"]);
    exit;
}

$database = new Database();
$db = $database->getConnection();

$user_id = $_SESSION['user_id'];
$holdings = $data['holdings'];

try {
    $db->beginTransaction();

    $clearQuery = "DELETE FROM portfolio_holdings WHERE user_id = :user_id";
    $clearStmt = $db->prepare($clearQuery);
    $clearStmt->bindParam(":user_id", $user_id);
    $clearStmt->execute();

    $successCount = 0;
    $errorCount = 0;

    foreach ($holdings as $pairId => $tokenHoldings) {
        foreach ($tokenHoldings as $holding) {
            if (empty($holding['token']['name']) || empty($holding['token']['symbol']) || 
                !isset($holding['amount'])) {
                error_log("Skipping invalid holding: " . json_encode($holding));
                $errorCount++;
                continue;
            }

            $query = "INSERT INTO portfolio_holdings 
                      (user_id, pair_id, token_name, token_symbol, amount, 
                       buy_price, current_price, added_date) 
                      VALUES (:user_id, :pair_id, :token_name, :token_symbol, :amount, 
                              :buy_price, :current_price, :added_date)";

            $stmt = $db->prepare($query);
            
            $tokenName = $holding['token']['name'];
            $tokenSymbol = $holding['token']['symbol'];
            $amount = floatval($holding['amount']);
            $buyPrice = floatval($holding['buyPrice'] ?? 0);
            $currentPrice = floatval($holding['currentPrice'] ?? $holding['buyPrice'] ?? 0);
            $addedDate = $holding['timestamp'] ?? date('Y-m-d H:i:s');

            if ($buyPrice <= 0) $buyPrice = $currentPrice;
            if ($currentPrice <= 0) $currentPrice = $buyPrice;

            $stmt->bindParam(":user_id", $user_id);
            $stmt->bindParam(":pair_id", $pairId);
            $stmt->bindParam(":token_name", $tokenName);
            $stmt->bindParam(":token_symbol", $tokenSymbol);
            $stmt->bindParam(":amount", $amount);
            $stmt->bindParam(":buy_price", $buyPrice);
            $stmt->bindParam(":current_price", $currentPrice);
            $stmt->bindParam(":added_date", $addedDate);

            if ($stmt->execute()) {
                $successCount++;
            } else {
                $errorCount++;
                $errorInfo = $stmt->errorInfo();
                error_log("Failed to execute portfolio insert: " . implode(", ", $errorInfo));
            }
        }
    }

    $db->commit();

    error_log("Portfolio saved - Success: $successCount, Errors: $errorCount");

    echo json_encode([
        "success" => true,
        "message" => "Portfolio stored successfully",
        "user_id" => $user_id,
        "success_count" => $successCount,
        "error_count" => $errorCount,
        "total" => $successCount + $errorCount
    ]);

} catch (PDOException $e) {
    $db->rollBack();
    error_log("Database error in store_portfolio: " . $e->getMessage());
    
    http_response_code(500);
    echo json_encode([
        "success" => false,
        "message" => "Database error: " . $e->getMessage()
    ]);
}
?>