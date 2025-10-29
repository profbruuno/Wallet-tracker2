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

$database = new Database();
$db = $database->getConnection();

$user_id = $_SESSION['user_id'];

try {
    $query = "
        SELECT 
            id,
            pair_id,
            token_name,
            token_symbol,
            amount,
            buy_price,
            current_price,
            added_date,
            updated_at
        FROM portfolio_holdings 
        WHERE user_id = :user_id 
        ORDER BY added_date DESC
    ";
    
    $stmt = $db->prepare($query);
    $stmt->bindParam(":user_id", $user_id);
    $stmt->execute();
    
    $holdings = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    error_log("Loaded " . count($holdings) . " portfolio items for user $user_id");
    
    $groupedHoldings = [];
    foreach ($holdings as $holding) {
        $pairId = $holding['pair_id'];
        if (!isset($groupedHoldings[$pairId])) {
            $groupedHoldings[$pairId] = [];
        }
        
        $groupedHoldings[$pairId][] = [
            'id' => $holding['id'],
            'token' => [
                'name' => $holding['token_name'],
                'symbol' => $holding['token_symbol'],
                'pairId' => $holding['pair_id']
            ],
            'amount' => floatval($holding['amount']),
            'buyPrice' => floatval($holding['buy_price']),
            'currentPrice' => floatval($holding['current_price']),
            'timestamp' => $holding['added_date'],
            'db_id' => $holding['id']
        ];
    }
    
    echo json_encode([
        "success" => true,
        "holdings" => $groupedHoldings,
        "count" => count($holdings)
    ]);
    
} catch (PDOException $e) {
    error_log("Error loading portfolio: " . $e->getMessage());
    http_response_code(500);
    echo json_encode([
        "success" => false,
        "message" => "Database error: " . $e->getMessage()
    ]);
}
?>