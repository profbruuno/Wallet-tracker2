<?php
session_start();

// Simple admin authentication
$admin_password = "admin123"; // Change this to a secure password

if ($_POST['login'] ?? false) {
    if ($_POST['password'] === $admin_password) {
        $_SESSION['admin_logged_in'] = true;
    } else {
        $error = "Invalid password";
    }
}

if (!($_SESSION['admin_logged_in'] ?? false)) {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Login - TikStake Memeboard</title>
        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }
            
            body {
                font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
                background: #0b1020;
                color: #e6e7ea;
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
            }
            
            .login-container {
                background: #0f172a;
                padding: 40px;
                border-radius: 12px;
                border: 1px solid #1f2937;
                box-shadow: 0 10px 25px rgba(0,0,0,0.3);
                width: 100%;
                max-width: 400px;
            }
            
            h1 {
                text-align: center;
                margin-bottom: 30px;
                color: #60a5fa;
                font-size: 1.8rem;
            }
            
            .form-group {
                margin-bottom: 20px;
            }
            
            label {
                display: block;
                margin-bottom: 8px;
                font-weight: 500;
                color: #9ca3af;
            }
            
            input[type="password"] {
                width: 100%;
                padding: 12px 15px;
                background: #1f2937;
                color: #e6e7ea;
                border: 1px solid #374151;
                border-radius: 8px;
                font-size: 16px;
                outline: none;
            }
            
            input[type="password"]:focus {
                border-color: #60a5fa;
                box-shadow: 0 0 0 3px rgba(96, 165, 250, 0.2);
            }
            
            .login-btn {
                width: 100%;
                padding: 12px;
                background: #3b82f6;
                color: white;
                border: none;
                border-radius: 8px;
                font-size: 16px;
                font-weight: 500;
                cursor: pointer;
                transition: background 0.2s;
            }
            
            .login-btn:hover {
                background: #2563eb;
            }
            
            .error {
                background: #dc2626;
                color: white;
                padding: 10px;
                border-radius: 6px;
                margin-bottom: 20px;
                text-align: center;
                font-size: 14px;
            }
        </style>
    </head>
    <body>
        <div class="login-container">
            <h1>Admin Login</h1>
            
            <?php if (isset($error)): ?>
                <div class="error"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>
            
            <form method="POST">
                <div class="form-group">
                    <label for="password">Admin Password:</label>
                    <input type="password" id="password" name="password" required autofocus>
                </div>
                <button type="submit" name="login" value="1" class="login-btn">Login</button>
            </form>
        </div>
    </body>
    </html>
    <?php
    exit;
}
?>
<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - TikStake Memeboard</title>
    <style>
        :root {
            --bg: #0b1020;
            --fg: #e6e7ea;
            --muted: #9aa0a6;
            --card: #0f172a;
            --border: #1f2937;
            --th-bg: #111827;
            --th-fg: #e6e7ea;
            --hover: #0b1220;
            --accent: #60a5fa;
            --change-positive: #22c55e;
            --change-negative: #ef4444;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: var(--bg);
            color: var(--fg);
            line-height: 1.5;
            padding: 20px;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 1px solid var(--border);
            flex-wrap: wrap;
            gap: 20px;
        }

        h1 {
            color: var(--accent);
            font-size: 2.2rem;
        }

        h2 {
            margin-bottom: 20px;
            color: var(--fg);
        }

        .admin-nav {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .nav-btn {
            padding: 10px 16px;
            background: var(--card);
            color: var(--fg);
            border: 1px solid var(--border);
            border-radius: 8px;
            cursor: pointer;
            font-weight: 500;
            transition: all 0.2s;
        }

        .nav-btn:hover, .nav-btn.active {
            background: var(--accent);
            color: white;
        }

        .logout-btn {
            padding: 10px 16px;
            background: var(--change-negative);
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 500;
        }

        .logout-btn:hover {
            background: #dc2626;
        }

        .section {
            background: var(--card);
            padding: 25px;
            border-radius: 12px;
            border: 1px solid var(--border);
            margin-bottom: 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: var(--th-bg);
            padding: 20px;
            border-radius: 8px;
            border: 1px solid var(--border);
            text-align: center;
        }

        .stat-number {
            font-size: 2rem;
            font-weight: bold;
            color: var(--accent);
            margin-bottom: 5px;
        }

        .stat-label {
            color: var(--muted);
            font-size: 0.9rem;
        }

        .table-scroll-wrapper {
            overflow-x: auto;
            border-radius: 8px;
            border: 1px solid var(--border);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: var(--card);
            min-width: 800px;
        }

        th, td {
            padding: 12px 15px;
            border: 1px solid var(--border);
            text-align: left;
        }

        th {
            background: var(--th-bg);
            color: var(--th-fg);
            font-weight: 600;
            position: sticky;
            top: 0;
        }

        tr:hover {
            background: var(--hover);
        }

        .loading {
            text-align: center;
            padding: 40px;
            color: var(--muted);
        }

        .profit-positive {
            color: var(--change-positive);
        }

        .profit-negative {
            color: var(--change-negative);
        }

        .user-email {
            word-break: break-all;
        }

        .action-btn {
            padding: 6px 12px;
            background: var(--accent);
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 12px;
            margin: 2px;
        }

        .action-btn.delete {
            background: var(--change-negative);
        }

        .action-btn:hover {
            opacity: 0.9;
        }

        .refresh-btn {
            padding: 10px 16px;
            background: var(--change-positive);
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 500;
            margin-bottom: 20px;
        }

        .refresh-btn:hover {
            background: #16a34a;
        }

        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .admin-nav {
                width: 100%;
                justify-content: center;
            }
            
            .section {
                padding: 15px;
            }
            
            th, td {
                padding: 8px 10px;
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Admin Dashboard</h1>
            <div style="display: flex; gap: 10px; align-items: center;">
                <div class="admin-nav">
                    <button class="nav-btn active" onclick="showSection('users')">Users</button>
                    <button class="nav-btn" onclick="showSection('tokens')">Tokens</button>
                    <button class="nav-btn" onclick="showSection('portfolio')">Portfolio</button>
                </div>
                <button class="logout-btn" onclick="logout()">Logout</button>
            </div>
        </div>

        <button class="refresh-btn" onclick="refreshData()">🔄 Refresh Data</button>

        <!-- Users Section -->
        <div id="users-section" class="section">
            <h2>User Management</h2>
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-number" id="totalUsers">-</div>
                    <div class="stat-label">Total Users</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number" id="activeUsers">-</div>
                    <div class="stat-label">Active Users (Last 7 days)</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number" id="usersWithPortfolio">-</div>
                    <div class="stat-label">Users with Portfolio</div>
                </div>
            </div>
            <div class="table-scroll-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>User ID</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Created At</th>
                            <th>Last Login</th>
                            <th>Portfolio Items</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="usersTableBody">
                        <tr><td colspan="8" class="loading">Loading users...</td></tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Tokens Section -->
        <div id="tokens-section" class="section" style="display: none;">
            <h2>Token Management</h2>
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-number" id="totalTokens">-</div>
                    <div class="stat-label">Total Tokens</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number" id="popularTokens">-</div>
                    <div class="stat-label">Popular Tokens</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number" id="newTokens">-</div>
                    <div class="stat-label">New Tokens</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number" id="highRiskTokens">-</div>
                    <div class="stat-label">High Risk Tokens</div>
                </div>
            </div>
            <div class="table-scroll-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>Pair ID</th>
                            <th>Name</th>
                            <th>Symbol</th>
                            <th>Category</th>
                            <th>Current Price</th>
                            <th>24h Change</th>
                            <th>Market Cap</th>
                            <th>Added Date</th>
                        </tr>
                    </thead>
                    <tbody id="tokensTableBody">
                        <tr><td colspan="8" class="loading">Loading tokens...</td></tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Portfolio Section -->
        <div id="portfolio-section" class="section" style="display: none;">
            <h2>Portfolio Holdings</h2>
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-number" id="totalHoldings">-</div>
                    <div class="stat-label">Total Holdings</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number" id="uniqueTokens">-</div>
                    <div class="stat-label">Unique Tokens</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number" id="activePortfolios">-</div>
                    <div class="stat-label">Active Portfolios</div>
                </div>
            </div>
            <div class="table-scroll-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>User ID</th>
                            <th>Username</th>
                            <th>Token</th>
                            <th>Symbol</th>
                            <th>Amount</th>
                            <th>Buy Price</th>
                            <th>Current Price</th>
                            <th>Current Value</th>
                            <th>Profit/Loss</th>
                            <th>Added Date</th>
                        </tr>
                    </thead>
                    <tbody id="portfolioTableBody">
                        <tr><td colspan="10" class="loading">Loading portfolio data...</td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        let currentSection = 'users';

        function showSection(section) {
            // Hide all sections
            document.getElementById('users-section').style.display = 'none';
            document.getElementById('tokens-section').style.display = 'none';
            document.getElementById('portfolio-section').style.display = 'none';
            
            // Remove active class from all buttons
            document.querySelectorAll('.nav-btn').forEach(btn => {
                btn.classList.remove('active');
            });
            
            // Show selected section and activate button
            document.getElementById(section + '-section').style.display = 'block';
            event.target.classList.add('active');
            currentSection = section;
            
            // Load data for the section if needed
            if (section === 'users') loadUsers();
            if (section === 'tokens') loadTokens();
            if (section === 'portfolio') loadPortfolio();
        }

        function logout() {
            if (confirm('Are you sure you want to logout?')) {
                window.location.href = 'admin.php?logout=1';
            }
        }

        function refreshData() {
            if (currentSection === 'users') loadUsers();
            if (currentSection === 'tokens') loadTokens();
            if (currentSection === 'portfolio') loadPortfolio();
        }

        async function loadUsers() {
            try {
                const response = await fetch('admin_api.php?action=getUsers');
                const data = await response.json();
                
                if (data.success) {
                    // Update stats
                    document.getElementById('totalUsers').textContent = data.stats.totalUsers;
                    document.getElementById('activeUsers').textContent = data.stats.activeUsers;
                    document.getElementById('usersWithPortfolio').textContent = data.stats.usersWithPortfolio;
                    
                    // Update table
                    const tbody = document.getElementById('usersTableBody');
                    tbody.innerHTML = '';
                    
                    if (data.users.length === 0) {
                        tbody.innerHTML = '<tr><td colspan="8" style="text-align: center;">No users found</td></tr>';
                        return;
                    }
                    
                    data.users.forEach(user => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td>${user.user_id}</td>
                            <td>${user.username}</td>
                            <td class="user-email">${user.email}</td>
                            <td>${formatDate(user.created_at)}</td>
                            <td>${formatDate(user.last_login)}</td>
                            <td>${user.portfolio_count || 0}</td>
                            <td>${user.is_active ? 'Active' : 'Inactive'}</td>
                            <td>
                                <button class="action-btn" onclick="viewUserPortfolio('${user.user_id}')">View Portfolio</button>
                                <button class="action-btn delete" onclick="deleteUser('${user.user_id}')">Delete</button>
                            </td>
                        `;
                        tbody.appendChild(row);
                    });
                } else {
                    throw new Error(data.message);
                }
            } catch (error) {
                console.error('Error loading users:', error);
                document.getElementById('usersTableBody').innerHTML = '<tr><td colspan="8">Error loading users: ' + error.message + '</td></tr>';
            }
        }

        async function loadTokens() {
            try {
                const response = await fetch('admin_api.php?action=getTokens');
                const data = await response.json();
                
                if (data.success) {
                    // Update stats
                    document.getElementById('totalTokens').textContent = data.stats.totalTokens;
                    document.getElementById('popularTokens').textContent = data.stats.popularTokens;
                    document.getElementById('newTokens').textContent = data.stats.newTokens;
                    document.getElementById('highRiskTokens').textContent = data.stats.highRiskTokens;
                    
                    // Update table
                    const tbody = document.getElementById('tokensTableBody');
                    tbody.innerHTML = '';
                    
                    if (data.tokens.length === 0) {
                        tbody.innerHTML = '<tr><td colspan="8" style="text-align: center;">No tokens found</td></tr>';
                        return;
                    }
                    
                    data.tokens.forEach(token => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td title="${token.pair_id}">${shortenAddress(token.pair_id)}</td>
                            <td>${token.name}</td>
                            <td><strong>${token.symbol}</strong></td>
                            <td>${formatCategory(token.category)}</td>
                            <td>${formatPrice(token.current_price)}</td>
                            <td class="${token.change_24h >= 0 ? 'profit-positive' : 'profit-negative'}">
                                ${token.change_24h >= 0 ? '+' : ''}${token.change_24h ? token.change_24h.toFixed(2) : '0.00'}%
                            </td>
                            <td>${formatMoney(token.market_cap)}</td>
                            <td>${formatDate(token.added_date)}</td>
                        `;
                        tbody.appendChild(row);
                    });
                } else {
                    throw new Error(data.message);
                }
            } catch (error) {
                console.error('Error loading tokens:', error);
                document.getElementById('tokensTableBody').innerHTML = '<tr><td colspan="8">Error loading tokens</td></tr>';
            }
        }

        async function loadPortfolio() {
            try {
                const response = await fetch('admin_api.php?action=getPortfolio');
                const data = await response.json();
                
                if (data.success) {
                    // Update stats
                    document.getElementById('totalHoldings').textContent = data.stats.totalHoldings;
                    document.getElementById('uniqueTokens').textContent = data.stats.uniqueTokens;
                    document.getElementById('activePortfolios').textContent = data.stats.activePortfolios;
                    
                    // Update table
                    const tbody = document.getElementById('portfolioTableBody');
                    tbody.innerHTML = '';
                    
                    if (data.holdings.length === 0) {
                        tbody.innerHTML = '<tr><td colspan="10" style="text-align: center;">No portfolio holdings found</td></tr>';
                        return;
                    }
                    
                    data.holdings.forEach(holding => {
                        const currentValue = holding.amount * holding.current_price;
                        const profitLoss = currentValue - (holding.amount * holding.buy_price);
                        
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td>${holding.user_id}</td>
                            <td>${holding.username || 'N/A'}</td>
                            <td>${holding.token_name}</td>
                            <td><strong>${holding.token_symbol}</strong></td>
                            <td>${parseFloat(holding.amount).toLocaleString()}</td>
                            <td>${formatPrice(holding.buy_price)}</td>
                            <td>${formatPrice(holding.current_price)}</td>
                            <td>${formatMoney(currentValue)}</td>
                            <td class="${profitLoss >= 0 ? 'profit-positive' : 'profit-negative'}">
                                ${formatMoney(profitLoss)}
                            </td>
                            <td>${formatDate(holding.added_date)}</td>
                        `;
                        tbody.appendChild(row);
                    });
                } else {
                    throw new Error(data.message);
                }
            } catch (error) {
                console.error('Error loading portfolio:', error);
                document.getElementById('portfolioTableBody').innerHTML = '<tr><td colspan="10">Error loading portfolio data</td></tr>';
            }
        }

        function viewUserPortfolio(userId) {
            alert(`View portfolio for user: ${userId}\nThis would show detailed portfolio view in a future enhancement.`);
        }

        function deleteUser(userId) {
            if (confirm(`Are you sure you want to delete user ${userId}? This will also delete their portfolio data.`)) {
                fetch('admin_api.php?action=deleteUser&userId=' + userId)
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('User deleted successfully');
                            loadUsers();
                        } else {
                            alert('Error deleting user: ' + data.message);
                        }
                    })
                    .catch(error => {
                        alert('Error deleting user: ' + error.message);
                    });
            }
        }

        // Utility functions
        function formatDate(dateString) {
            if (!dateString || dateString === '0000-00-00 00:00:00') return '-';
            try {
                return new Date(dateString).toLocaleDateString() + ' ' + new Date(dateString).toLocaleTimeString();
            } catch (e) {
                return dateString;
            }
        }

        function formatPrice(price) {
            if (!price || price === null) return '-';
            if (price >= 1) {
                return '$' + price.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 });
            }
            return '$' + parseFloat(price).toFixed(6);
        }

        function formatMoney(amount) {
            if (!amount || amount === null) return '-';
            amount = parseFloat(amount);
            if (amount >= 1_000_000_000) return '$' + (amount / 1_000_000_000).toFixed(2) + 'B';
            if (amount >= 1_000_000) return '$' + (amount / 1_000_000).toFixed(2) + 'M';
            if (amount >= 1_000) return '$' + (amount / 1_000).toFixed(2) + 'K';
            return '$' + amount.toFixed(2);
        }

        function shortenAddress(address) {
            if (!address) return '-';
            return address.length > 20 ? address.substring(0, 10) + '...' + address.substring(address.length - 10) : address;
        }

        function formatCategory(category) {
            const categories = {
                'popular': 'Popular',
                'new': 'New Listings', 
                'high_risk': 'High Risk'
            };
            return categories[category] || category;
        }

        // Load initial data
        loadUsers();
    </script>
</body>
</html>
<?php
// Handle logout
if ($_GET['logout'] ?? false) {
    session_destroy();
    header('Location: admin.php');
    exit;
}
?>