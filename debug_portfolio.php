<?php
// Debug script to check portfolio data
header('Content-Type: text/plain');
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'config.php';

session_start();

echo "=== Portfolio Debug ===\n";
echo "User logged in: " . (isset($_SESSION['logged_in']) ? 'YES' : 'NO') . "\n";
echo "User ID: " . ($_SESSION['user_id'] ?? 'NONE') . "\n\n";

if (!isset($_SESSION['logged_in'])) {
    exit("User not logged in\n");
}

$database = new Database();
$db = $database->getConnection();

$user_id = $_SESSION['user_id'];

// Check portfolio_holdings table
echo "Checking portfolio_holdings table:\n";
try {
    $query = "SELECT COUNT(*) as count FROM portfolio_holdings WHERE user_id = ?";
    $stmt = $db->prepare($query);
    $stmt->execute([$user_id]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "Total holdings for user: " . $result['count'] . "\n\n";

    if ($result['count'] > 0) {
        $query = "SELECT * FROM portfolio_holdings WHERE user_id = ? ORDER BY added_date DESC LIMIT 5";
        $stmt = $db->prepare($query);
        $stmt->execute([$user_id]);
        $holdings = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        echo "Recent holdings:\n";
        foreach ($holdings as $holding) {
            echo " - " . $holding['token_name'] . " (" . $holding['token_symbol'] . "): " . $holding['amount'] . " @ $" . $holding['buy_price'] . "\n";
        }
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}

echo "\n=== End Debug ===\n";
?>