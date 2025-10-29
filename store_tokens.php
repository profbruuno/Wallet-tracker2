<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(["message" => "Method not allowed"]);
    exit;
}

$data = json_decode(file_get_contents("php://input"), true);

if (!$data || !isset($data['tokens']) || !isset($data['category'])) {
    http_response_code(400);
    echo json_encode(["message" => "Invalid data"]);
    exit;
}

$database = new Database();
$db = $database->getConnection();

$tokens = $data['tokens'];
$category = $data['category'];

$successCount = 0;
$errorCount = 0;

foreach ($tokens as $token) {
    try {
        $query = "INSERT INTO tokens 
                  (pair_id, name, symbol, current_price, volume_24h, change_24h, 
                   liquidity, market_cap, token_address, added_date, listing_price, category) 
                  VALUES (:pair_id, :name, :symbol, :current_price, :volume_24h, :change_24h, 
                          :liquidity, :market_cap, :token_address, :added_date, :listing_price, :category) 
                  ON DUPLICATE KEY UPDATE 
                  name = VALUES(name),
                  symbol = VALUES(symbol),
                  current_price = VALUES(current_price),
                  volume_24h = VALUES(volume_24h),
                  change_24h = VALUES(change_24h),
                  liquidity = VALUES(liquidity),
                  market_cap = VALUES(market_cap),
                  token_address = VALUES(token_address),
                  updated_at = CURRENT_TIMESTAMP";

        $stmt = $db->prepare($query);
        
        $stmt->bindParam(":pair_id", $token['pairId']);
        $stmt->bindParam(":name", $token['name']);
        $stmt->bindParam(":symbol", $token['symbol']);
        $stmt->bindParam(":current_price", $token['price']);
        $stmt->bindParam(":volume_24h", $token['volume']);
        $stmt->bindParam(":change_24h", $token['change']);
        $stmt->bindParam(":liquidity", $token['liquidityUsd']);
        $stmt->bindParam(":market_cap", $token['marketCap']);
        $stmt->bindParam(":token_address", $token['tokenAddress']);
        $stmt->bindParam(":added_date", $token['addedDate']);
        $stmt->bindParam(":listing_price", $token['listingPrice']);
        $stmt->bindParam(":category", $category);

        if ($stmt->execute()) {
            $successCount++;
        } else {
            $errorCount++;
        }
    } catch (PDOException $e) {
        error_log("Database error: " . $e->getMessage());
        $errorCount++;
    }
}

echo json_encode([
    "message" => "Tokens stored successfully",
    "success" => $successCount,
    "errors" => $errorCount,
    "total" => count($tokens)
]);
?>