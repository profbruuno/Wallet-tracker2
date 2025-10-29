<?php
include 'config.php';

session_start();

// Check if admin is logged in
if (!($_SESSION['admin_logged_in'] ?? false)) {
    http_response_code(401);
    echo json_encode(["success" => false, "message" => "Unauthorized"]);
    exit;
}

$database = new Database();
$db = $database->getConnection();

$action = $_GET['action'] ?? '';

try {
    switch ($action) {
        case 'getUsers':
            getUsers($db);
            break;
            
        case 'getTokens':
            getTokens($db);
            break;
            
        case 'getPortfolio':
            getPortfolio($db);
            break;
            
        case 'deleteUser':
            deleteUser($db);
            break;
            
        default:
            http_response_code(400);
            echo json_encode(["success" => false, "message" => "Invalid action"]);
    }
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["success" => false, "message" => "Database error: " . $e->getMessage()]);
}

function getUsers($db) {
    // Get user statistics from users table
    $statsQuery = "
        SELECT 
            COUNT(*) as totalUsers,
            COUNT(CASE WHEN last_login >= DATE_SUB(NOW(), INTERVAL 7 DAY) THEN 1 END) as activeUsers,
            (SELECT COUNT(DISTINCT user_id) FROM portfolio_holdings) as usersWithPortfolio
        FROM users
    ";
    $stmt = $db->prepare($statsQuery);
    $stmt->execute();
    $stats = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // Get users from users table
    $usersQuery = "
        SELECT 
            id as user_id,
            email,
            username,
            created_at,
            last_login,
            is_active
        FROM users
        ORDER BY created_at DESC
    ";
    $stmt = $db->prepare($usersQuery);
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Get portfolio counts for each user
    foreach ($users as &$user) {
        $portfolioQuery = "
            SELECT COUNT(*) as portfolio_count 
            FROM portfolio_holdings 
            WHERE user_id = :user_id
        ";
        $portfolioStmt = $db->prepare($portfolioQuery);
        $portfolioStmt->bindParam(":user_id", $user['user_id']);
        $portfolioStmt->execute();
        $portfolioData = $portfolioStmt->fetch(PDO::FETCH_ASSOC);
        $user['portfolio_count'] = $portfolioData['portfolio_count'] ?? 0;
    }
    
    echo json_encode([
        "success" => true,
        "stats" => $stats,
        "users" => $users
    ]);
}

function getTokens($db) {
    // Get token statistics by category
    $statsQuery = "
        SELECT 
            COUNT(*) as totalTokens,
            COUNT(CASE WHEN category = 'popular' THEN 1 END) as popularTokens,
            COUNT(CASE WHEN category = 'new' THEN 1 END) as newTokens,
            COUNT(CASE WHEN category = 'high_risk' THEN 1 END) as highRiskTokens
        FROM tokens
    ";
    $stmt = $db->prepare($statsQuery);
    $stmt->execute();
    $stats = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // Get all tokens
    $tokensQuery = "
        SELECT * FROM tokens 
        ORDER BY updated_at DESC
    ";
    $stmt = $db->prepare($tokensQuery);
    $stmt->execute();
    $tokens = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode([
        "success" => true,
        "stats" => $stats,
        "tokens" => $tokens
    ]);
}

function getPortfolio($db) {
    // Get portfolio statistics
    $statsQuery = "
        SELECT 
            COUNT(*) as totalHoldings,
            COUNT(DISTINCT token_symbol) as uniqueTokens,
            COUNT(DISTINCT user_id) as activePortfolios
        FROM portfolio_holdings
    ";
    $stmt = $db->prepare($statsQuery);
    $stmt->execute();
    $stats = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // Get all portfolio holdings with user info
    $portfolioQuery = "
        SELECT 
            p.*,
            u.username,
            u.email,
            t.current_price as current_price
        FROM portfolio_holdings p
        LEFT JOIN users u ON p.user_id = u.id
        LEFT JOIN tokens t ON p.pair_id = t.pair_id
        ORDER BY p.added_date DESC
    ";
    $stmt = $db->prepare($portfolioQuery);
    $stmt->execute();
    $holdings = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode([
        "success" => true,
        "stats" => $stats,
        "holdings" => $holdings
    ]);
}

function deleteUser($db) {
    $userId = $_GET['userId'] ?? '';
    
    if (empty($userId)) {
        http_response_code(400);
        echo json_encode(["success" => false, "message" => "User ID required"]);
        return;
    }
    
    // Start transaction
    $db->beginTransaction();
    
    try {
        // Delete portfolio holdings
        $deleteHoldingsQuery = "DELETE FROM portfolio_holdings WHERE user_id = :user_id";
        $stmt = $db->prepare($deleteHoldingsQuery);
        $stmt->bindParam(":user_id", $userId);
        $stmt->execute();
        
        // Delete user from users table
        $deleteUserQuery = "DELETE FROM users WHERE id = :user_id";
        $stmt = $db->prepare($deleteUserQuery);
        $stmt->bindParam(":user_id", $userId);
        $stmt->execute();
        
        $db->commit();
        
        echo json_encode(["success" => true, "message" => "User deleted successfully"]);
        
    } catch (Exception $e) {
        $db->rollBack();
        throw $e;
    }
}
?>