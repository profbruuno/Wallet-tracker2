<?php
session_start();
$logged_in = isset($_SESSION['logged_in']) && $_SESSION['logged_in'];
$current_user = $logged_in ? [
    'id' => $_SESSION['user_id'],
    'email' => $_SESSION['user_email'],
    'username' => $_SESSION['username']
] : null;

// Debug: Check if session is working
error_log("User login status: " . ($logged_in ? 'LOGGED IN as ' . $current_user['username'] : 'NOT LOGGED IN'));

// Check for messages
$register_error = $_GET['register_error'] ?? '';
$register_success = $_GET['register_success'] ?? '';
$login_error = $_GET['login_error'] ?? '';
$login_success = $_GET['login_success'] ?? '';
$logout_success = $_GET['logout_success'] ?? '';
?>
<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>TikStake Memeboard</title>
  <link rel="stylesheet" href="styles.css" />
</head>
<body>
  <div class="container">
    <header class="header">
      <div class="header-main">
        <div>
          <h1>TikStake Memeboard</h1>
          <div class="status" id="connectionStatus">
            <span class="status-dot online"></span>
            <span id="statusText">Connected</span>
          </div>
        </div>
      </div>
      
      <div class="header-controls">
        <div class="header-buttons">
          <button id="refreshBtn" class="refresh-btn">🔄 Refresh</button>
          <button id="tradeBtn" class="trade-btn">💎 Trade</button>
          <button id="portfolioBtn" class="portfolio-btn <?php echo $logged_in ? 'authenticated' : ''; ?>">
            📊 <?php echo $logged_in ? 'Portfolio' : 'Portfolio Tracker'; ?>
          </button>
          
          <?php if ($logged_in): ?>
            <div class="user-display">
              <div class="user-avatar">
                <?php echo strtoupper(substr($current_user['username'], 0, 1)); ?>
              </div>
              <span class="user-name"><?php echo htmlspecialchars($current_user['username']); ?></span>
            </div>
            <a href="logout.php" class="logout-btn">🚪 Logout</a>
          <?php else: ?>
            <span id="authStatus" style="display: none;"></span>
          <?php endif; ?>
          
          <button id="themeToggle" class="theme-toggle">
            <span class="theme-icon">🌙</span> Theme
          </button>
        </div>
      </div>
    </header>

    <p class="muted">
      Auto-refreshes every 2 minutes  • Last updated: <span id="lastUpdated">-</span>
    </p>

    <!-- Trade Modal -->
    <div id="tradeModal" class="modal">
      <div class="modal-content">
        <span class="close">&times;</span>
        <div class="modal-header">
          <h2>Trade Solana Memecoins</h2>
        </div>
        <div class="modal-body">
          <p>Maximize your trading potential with these benefits:</p>
          <ul>
            <li>Low transaction fees on Solana network</li>
            <li>Fast transaction processing</li>
            <li>High potential returns</li>
            <li>Diverse token selection</li>
            <li>Innovative trading tools</li>
            <li>Global community of traders</li>
            <li>Real-time market data</li>
            <li>Mobile trading compatibility</li>
            <li>Low barrier to entry</li>
          </ul>
          
          <div class="referral-section">
            <h3>Enhanced Trading with Trojan Bot</h3>
            <p>Use our referral link to access powerful trading tools on Telegram:</p>
            <a href="https://t.me/solana_trojanbot?start=r-profbrunoo" target="_blank" class="referral-link">
              https://t.me/solana_trojanbot?start=r-profbrunoo
            </a>
            <p class="bonus-note">Your friends save 10% with your link!</p>
            
            <h4>Trojan Bot Features:</h4>
            <ul>
              <li>Key Features of the Trojan Bot</li>
              <li>Non-Custodial Wallet Integration</li>
              <li>Lightning-Fast Trades</li> 
              <li>Anti-MEV Protection</li>
              <li>Automated Sniping</li>
              <li>Advanced Order Types</li>
              <li>Limit Orders</li>
              <li>DCA (Dollar-Cost Averaging) Orders</li>
              <li>Copy Trading</li>
              <li>Real-Time Monitoring & Alerts</li>
              <li>High Security</li> 
              <li>Intelligent Routing</li>
              <li>Bridge & Withdrawal Functionality</li>
              <li>Real-time token alerts</li>
              <li>Automated trading strategies</li>
              <li>Portfolio tracking</li>
              <li>Customizable notifications</li>
            </ul>
          </div>
          
          <div class="referral-section">
            <h3>Getting Started with Solana Memecoins</h3>
            <p>New to trading Solana memecoins? Follow these steps:</p>
            <ol>
              <li>Set up a Solana wallet (Phantom, Solflare, or Backpack)</li>
              <li>Fund your wallet with SOL from an exchange</li>
              <li>Use decentralized exchanges like Raydium or Orca</li>
              <li>Research tokens before investing</li>
              <li>Start with small investments</li>
              <li>Use stop-losses to manage risk</li>
              <li>Join community channels for insights</li>
            </ol>
            
            <p>Remember: Memecoin trading involves significant risk. Only invest what you can afford to lose, and always do your own research.</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Portfolio Tracker Modal -->
    <div id="portfolioModal" class="modal">
      <div class="modal-content portfolio-modal">
        <span class="close">&times;</span>
        <div class="modal-header">
          <h2>Portfolio Tracker</h2>
          <p class="muted">Track your investments and performance</p>
        </div>
        
        <div class="modal-body">
          <?php if (!$logged_in): ?>
          <!-- Authentication Section -->
          <div class="auth-section" id="authSection">
            <!-- Display Messages -->
            <?php if ($register_error): ?>
              <div class="auth-message error"><?php echo htmlspecialchars($register_error); ?></div>
            <?php endif; ?>
            <?php if ($register_success): ?>
              <div class="auth-message success"><?php echo htmlspecialchars($register_success); ?></div>
            <?php endif; ?>
            <?php if ($login_error): ?>
              <div class="auth-message error"><?php echo htmlspecialchars($login_error); ?></div>
            <?php endif; ?>
            <?php if ($login_success): ?>
              <div class="auth-message success"><?php echo htmlspecialchars($login_success); ?></div>
            <?php endif; ?>
            <?php if ($logout_success): ?>
              <div class="auth-message success"><?php echo htmlspecialchars($logout_success); ?></div>
            <?php endif; ?>

            <div class="auth-tabs">
              <button class="auth-tab active" onclick="switchAuthTab('login')">Login</button>
              <button class="auth-tab" onclick="switchAuthTab('register')">Sign Up</button>
            </div>
            
            <!-- Login Form -->
            <div id="loginForm" class="auth-form">
              <h3>Login to Your Account</h3>
              <form action="login.php" method="POST" id="loginFormElement">
                <div class="form-group">
                  <label for="loginEmail">Email:</label>
                  <input type="email" id="loginEmail" name="email" class="token-input" placeholder="Enter your email" required>
                </div>
                <div class="form-group">
                  <label for="loginPassword">Password:</label>
                  <input type="password" id="loginPassword" name="password" class="token-input" placeholder="Enter your password" required>
                </div>
                <button type="submit" class="btn btn-primary" style="width: 100%; padding: 12px;">Login</button>
              </form>
              <p class="muted" style="text-align: center; margin-top: 15px;">
                Don't have an account? <a href="javascript:void(0)" onclick="switchAuthTab('register')" style="color: var(--accent);">Sign up here</a>
              </p>
            </div>
            
            <!-- Register Form -->
            <div id="registerForm" class="auth-form" style="display: none;">
              <h3>Create New Account</h3>
              <form action="register.php" method="POST" id="registerFormElement">
                <div class="form-group">
                  <label for="registerUsername">Username:</label>
                  <input type="text" id="registerUsername" name="username" class="token-input" placeholder="Choose a username (3-50 characters)" required minlength="3" maxlength="50">
                </div>
                <div class="form-group">
                  <label for="registerEmail">Email:</label>
                  <input type="email" id="registerEmail" name="email" class="token-input" placeholder="Enter your email" required>
                </div>
                <div class="form-group">
                  <label for="registerPassword">Password:</label>
                  <input type="password" id="registerPassword" name="password" class="token-input" placeholder="Create a password (min. 6 characters)" required minlength="6">
                  <div class="password-strength"></div>
                </div>
                <div class="form-group">
                  <label for="registerConfirmPassword">Confirm Password:</label>
                  <input type="password" id="registerConfirmPassword" name="confirm_password" class="token-input" placeholder="Confirm your password" required>
                </div>
                <button type="submit" class="btn btn-primary" style="width: 100%; padding: 12px;">Create Account</button>
              </form>
              <p class="muted" style="text-align: center; margin-top: 15px;">
                Already have an account? <a href="javascript:void(0)" onclick="switchAuthTab('login')" style="color: var(--accent);">Login here</a>
              </p>
            </div>
          </div>
          <?php else: ?>
          <!-- Portfolio Content (Shown when authenticated) -->
          <div class="portfolio-content" id="portfolioContent">
            <!-- User Info Display -->
            <div class="user-info-display" id="userInfoDisplay">
              <div class="user-badge">
                <div class="user-main">
                  <div class="user-avatar-large">
                    <?php echo strtoupper(substr($current_user['username'], 0, 1)); ?>
                  </div>
                  <div class="user-details">
                    <strong>Welcome, <?php echo htmlspecialchars($current_user['username']); ?></strong>
                    <div class="user-email"><?php echo htmlspecialchars($current_user['email']); ?></div>
                  </div>
                </div>
                <a href="logout.php" class="btn btn-danger">Logout</a>
              </div>
            </div>

            <!-- Add Token Form -->
            <div class="add-token-form">
              <h3>Add Token to Portfolio</h3>
              <div class="form-group">
                <label for="tokenSelect">Select Token:</label>
                <select id="tokenSelect" class="token-select">
                  <option value="">Choose a token...</option>
                  <!-- Tokens will be populated dynamically -->
                </select>
              </div>
              
              <div class="form-group">
                <label for="tokenAmount">Amount of Tokens:</label>
                <input type="number" id="tokenAmount" min="0" step="0.000001" placeholder="Enter amount" class="token-input">
              </div>
              
              <div class="form-group">
                <label for="buyPrice">Buy Price (Optional):</label>
                <input type="number" id="buyPrice" min="0" step="0.000001" placeholder="Enter buy price in USD" class="token-input">
                <small class="muted">If not provided, current price will be used</small>
              </div>
              
              <button id="addTokenBtn" class="btn btn-primary" style="width: 100%;">Add to Portfolio</button>
            </div>

            <!-- Portfolio Summary -->
            <div class="portfolio-summary" id="portfolioSummary" style="display: none;">
              <h3>Portfolio Summary</h3>
              <div class="summary-cards">
                <div class="summary-card">
                  <strong>Total Value</strong>
                  <span id="totalValue" class="summary-value">$0.00</span>
                </div>
                <div class="summary-card">
                  <strong>Total Profit/Loss</strong>
                  <span id="totalProfitLoss" class="summary-value">$0.00</span>
                </div>
                <div class="summary-card">
                  <strong>Total ROI</strong>
                  <span id="totalROI" class="summary-value">0.00%</span>
                </div>
              </div>
            </div>

            <!-- Portfolio Table -->
            <div class="portfolio-table-container" id="portfolioTableContainer" style="display: none;">
              <h3>Your Holdings</h3>
              <div class="table-scroll-wrapper">
                <table class="portfolio-table">
                  <thead>
                    <tr>
                      <th>Token</th>
                      <th>Amount</th>
                      <th>Avg Buy Price</th>
                      <th>Current Price</th>
                      <th>Current Value</th>
                      <th>Profit/Loss</th>
                      <th>ROI</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody id="portfolioTableBody">
                    <!-- Portfolio items will be populated here -->
                  </tbody>
                </table>
              </div>
            </div>

            <!-- Empty Portfolio State -->
            <div class="empty-portfolio" id="emptyPortfolio">
              <div class="empty-state">
                <h3>No tokens in portfolio yet</h3>
                <p>Add your first token to start tracking your investments</p>
              </div>
            </div>
          </div>
          <?php endif; ?>
        </div>
        
        <?php if ($logged_in): ?>
        <div class="modal-footer" id="portfolioFooter">
          <button id="clearPortfolioBtn" class="btn btn-danger">Clear Portfolio</button>
          <button id="exportPortfolioBtn" class="btn btn-primary">Export Data</button>
        </div>
        <?php endif; ?>
      </div>
    </div>

    <!-- Popular Memecoins -->
    <div class="section">
      <h2>Popular Memecoins</h2>
      <div class="table-scroll-wrapper">
        <table>
          <thead>
            <tr>
              <th data-sort="name">Name</th>
              <th data-sort="symbol">Symbol</th>
              <th data-sort="price">Price</th>
              <th data-sort="volume">Volume (24h)</th>
              <th data-sort="change">Change (24h)</th>
              <th data-sort="liquidity">Liquidity</th>
              <th data-sort="marketCap">Market Cap</th>
            </tr>
          </thead>
          <tbody id="popular-tokens">
            <tr><td colspan="7" class="loading">Loading popular tokens...</td></tr>
          </tbody>
        </table>
      </div>
    </div>

    <!-- New Listings -->
    <div class="section">
      <h2>New Listings</h2>

      <div class="controls">
        <input type="text" id="searchInput" placeholder="Search token..." />
        <select id="sortSelect">
          <option value="">Sort by</option>
          <option value="price">Price</option>
          <option value="volume">Volume</option>
          <option value="change">24h Change</option>
          <option value="liquidity">Liquidity</option>
          <option value="marketCap">Market Cap</option>
        </select>
        <select id="filterSelect">
          <option value="">All tokens</option>
          <option value="gainers">Gainers only</option>
          <option value="losers">Losers only</option>
        </select>
      </div>

      <div class="table-scroll-wrapper">
        <table>
          <thead>
            <tr>
              <th data-sort="name">Name</th>
              <th data-sort="symbol">Symbol</th>
              <th data-sort="price">Price</th>
              <th data-sort="volume">Volume (24h)</th>
              <th data-sort="change">Change (24h)</th>
              <th data-sort="liquidity">Liquidity</th>
              <th data-sort="marketCap">Market Cap</th>
            </tr>
          </thead>
          <tbody id="new-tokens">
            <tr><td colspan="7" class="loading">Loading new tokens...</td></tr>
          </tbody>
        </table>
      </div>

      <p class="muted">Click a token to open chart and details in a new tab</p>
    </div>

    <!-- Highly Risky Tokens -->
    <div class="section">
      <div class="high-risk-header">
        <h2>Highly Risky</h2>
        <p class="subheading">But Big Bangers</p>
      </div>
      
      <div class="controls">
        <input type="text" id="highriskSearchInput" placeholder="Search high risk token..." />
        <select id="highriskSortSelect">
          <option value="">Sort by</option>
          <option value="price">Price</option>
          <option value="volume">Volume</option>
          <option value="change">24h Change</option>
          <option value="liquidity">Liquidity</li>
          <option value="marketCap">Market Cap</option>
        </select>
        <select id="highriskFilterSelect">
          <option value="">All tokens</option>
          <option value="gainers">Gainers only</option>
          <option value="losers">Losers only</option>
        </select>
      </div>

      <div class="table-scroll-wrapper">
        <table>
          <thead>
            <tr>
              <th data-sort="name">Name</th>
              <th data-sort="symbol">Symbol</th>
              <th data-sort="price">Price</th>
              <th data-sort="volume">Volume (24h)</th>
              <th data-sort="change">Change (24h)</th>
              <th data-sort="liquidity">Liquidity</th>
              <th data-sort="marketCap">Market Cap</th>
            </tr>
          </thead>
          <tbody id="highrisk-tokens">
            <tr><td colspan="7" class="loading">Loading high risk tokens...</td></tr>
          </tbody>
        </table>
      </div>

      <p class="muted warning-text">
        <strong>Warning:</strong> These tokens are highly speculative and risky. Only invest what you can afford to lose.
      </p>
    </div>

    <div class="footer">
      <p>TikStake Memeboard &copy; 2025 • Information provided here should not be taken as a financial advice, please do your own research </p>
    </div>
  </div>

  <script>
    // Set currentUser from PHP session
    let currentUser = <?php echo $logged_in ? json_encode($current_user) : 'null'; ?>;
    console.log('Current user from PHP:', currentUser);
  </script>
  <script src="script.js"></script>
  
  <!-- Enhanced authentication and modal handling -->
  <script>
  // Enhanced authentication state management
  function checkAuthState() {
      const portfolioModal = document.getElementById('portfolioModal');
      const authSection = document.getElementById('authSection');
      const portfolioContent = document.getElementById('portfolioContent');
      
      if (!portfolioModal) return;
      
      // Check if user is logged in via PHP session
      const isLoggedIn = <?php echo $logged_in ? 'true' : 'false'; ?>;
      console.log('Auth state check - Logged in:', isLoggedIn);
      
      if (isLoggedIn) {
          // User is logged in - show portfolio content
          if (authSection) authSection.style.display = 'none';
          if (portfolioContent) portfolioContent.style.display = 'block';
          
          // Initialize portfolio manager
          if (typeof portfolioManager !== 'undefined') {
              setTimeout(() => {
                  portfolioManager.initializeAvailableTokens();
                  portfolioManager.populateTokenDropdown();
                  portfolioManager.loadPortfolioFromServer();
              }, 100);
          }
      } else {
          // User is not logged in - show auth form
          if (authSection) authSection.style.display = 'block';
          if (portfolioContent) portfolioContent.style.display = 'none';
      }
  }

  // Enhanced modal open handler
  function setupPortfolioModal() {
      const portfolioBtn = document.getElementById('portfolioBtn');
      const portfolioModal = document.getElementById('portfolioModal');
      
      if (portfolioBtn && portfolioModal) {
          portfolioBtn.addEventListener('click', function() {
              console.log('Portfolio modal opened');
              portfolioModal.style.display = 'block';
              checkAuthState(); // Re-check auth state when modal opens
              
              // If logged in, initialize portfolio
              const isLoggedIn = <?php echo $logged_in ? 'true' : 'false'; ?>;
              if (isLoggedIn && typeof portfolioManager !== 'undefined') {
                  console.log('Initializing portfolio for logged in user');
                  portfolioManager.initializeAvailableTokens();
                  portfolioManager.populateTokenDropdown();
                  portfolioManager.loadPortfolioFromServer();
              }
          });
      }
  }

  // Enhanced message display
  function showAuthMessages() {
      const urlParams = new URLSearchParams(window.location.search);
      
      // Check for register messages
      const registerError = urlParams.get('register_error');
      const registerSuccess = urlParams.get('register_success');
      
      // Check for login messages  
      const loginError = urlParams.get('login_error');
      const loginSuccess = urlParams.get('login_success');
      
      // Auto-open portfolio modal if there are auth messages
      if (registerError || registerSuccess || loginError || loginSuccess) {
          const portfolioModal = document.getElementById('portfolioModal');
          if (portfolioModal) {
              portfolioModal.style.display = 'block';
              checkAuthState();
          }
          
          // Switch to appropriate tab
          if (registerError || registerSuccess) {
              switchAuthTab('register');
          } else if (loginError || loginSuccess) {
              switchAuthTab('login');
          }
          
          // Clear URL parameters after displaying messages
          if (window.history.replaceState) {
              const newUrl = window.location.pathname;
              window.history.replaceState({}, document.title, newUrl);
          }
      }
  }

  // Enhanced tab switching with message clearing
  function switchAuthTab(tab) {
      const loginForm = document.getElementById('loginForm');
      const registerForm = document.getElementById('registerForm');
      const tabs = document.querySelectorAll('.auth-tab');
      
      // Clear any existing messages
      const existingMessages = document.querySelectorAll('.auth-message');
      existingMessages.forEach(msg => msg.remove());
      
      tabs.forEach(t => t.classList.remove('active'));
      
      if (tab === 'login') {
          if (loginForm) loginForm.style.display = 'block';
          if (registerForm) registerForm.style.display = 'none';
          const loginTab = document.querySelector('.auth-tab:nth-child(1)');
          if (loginTab) loginTab.classList.add('active');
      } else {
          if (loginForm) loginForm.style.display = 'none';
          if (registerForm) registerForm.style.display = 'block';
          const registerTab = document.querySelector('.auth-tab:nth-child(2)');
          if (registerTab) registerTab.classList.add('active');
      }
  }

  // Enhanced form validation
  function setupFormValidation() {
      const forms = document.querySelectorAll('form');
      
      forms.forEach(form => {
          form.addEventListener('submit', function(e) {
              const inputs = this.querySelectorAll('input[required]');
              let isValid = true;
              
              inputs.forEach(input => {
                  if (!input.value.trim()) {
                      isValid = false;
                      input.style.borderColor = 'var(--change-negative)';
                  } else {
                      input.style.borderColor = '';
                  }
              });
              
              // Password confirmation validation
              const password = document.getElementById('registerPassword');
              const confirmPassword = document.getElementById('registerConfirmPassword');
              if (password && confirmPassword && password.value !== confirmPassword.value) {
                  isValid = false;
                  confirmPassword.style.borderColor = 'var(--change-negative)';
                  if (!document.getElementById('passwordMatchError')) {
                      const error = document.createElement('div');
                      error.id = 'passwordMatchError';
                      error.className = 'auth-message error';
                      error.textContent = 'Passwords do not match';
                      confirmPassword.parentNode.appendChild(error);
                  }
              }
              
              if (!isValid) {
                  e.preventDefault();
                  // Remove existing message if any
                  const existingMsg = this.querySelector('.auth-message.error');
                  if (existingMsg) existingMsg.remove();
                  
                  const message = document.createElement('div');
                  message.className = 'auth-message error';
                  message.textContent = 'Please fix the errors above';
                  this.insertBefore(message, this.firstChild);
              }
          });
      });
  }

  // Password strength indicator
  function setupPasswordStrength() {
      const passwordInput = document.getElementById('registerPassword');
      if (!passwordInput) return;
      
      const strengthBar = document.createElement('div');
      strengthBar.className = 'password-strength';
      passwordInput.parentNode.appendChild(strengthBar);
      
      passwordInput.addEventListener('input', function() {
          const password = this.value;
          let strength = 0;
          
          if (password.length >= 6) strength += 25;
          if (password.match(/[a-z]/) && password.match(/[A-Z]/)) strength += 25;
          if (password.match(/\d/)) strength += 25;
          if (password.match(/[^a-zA-Z\d]/)) strength += 25;
          
          strengthBar.className = 'password-strength';
          if (strength > 0) {
              strengthBar.classList.add(
                  strength <= 25 ? 'strength-weak' :
                  strength <= 50 ? 'strength-fair' :
                  strength <= 75 ? 'strength-good' : 'strength-strong'
              );
          }
      });
  }

  // Initialize when page loads
  document.addEventListener('DOMContentLoaded', function() {
      console.log('Initializing authentication system...');
      checkAuthState();
      setupPortfolioModal();
      showAuthMessages();
      setupFormValidation();
      setupPasswordStrength();
      
      // Update portfolio button text based on login state
      const portfolioBtn = document.getElementById('portfolioBtn');
      const isLoggedIn = <?php echo $logged_in ? 'true' : 'false'; ?>;
      
      if (portfolioBtn) {
          if (isLoggedIn) {
              portfolioBtn.textContent = '📊 Portfolio';
              portfolioBtn.classList.add('authenticated');
          } else {
              portfolioBtn.textContent = '📊 Portfolio Tracker';
              portfolioBtn.classList.remove('authenticated');
          }
      }
      
      // Add token button event listener
      const addTokenBtn = document.getElementById('addTokenBtn');
      if (addTokenBtn) {
          addTokenBtn.addEventListener('click', function() {
              console.log('Add token button clicked');
              addTokenToPortfolio();
          });
      }
      
      // Clear portfolio button
      const clearPortfolioBtn = document.getElementById('clearPortfolioBtn');
      if (clearPortfolioBtn) {
          clearPortfolioBtn.addEventListener('click', function() {
              if (typeof portfolioManager !== 'undefined') {
                  portfolioManager.clearPortfolio();
              }
          });
      }
      
      // Export portfolio button
      const exportPortfolioBtn = document.getElementById('exportPortfolioBtn');
      if (exportPortfolioBtn) {
          exportPortfolioBtn.addEventListener('click', function() {
              if (typeof portfolioManager !== 'undefined') {
                  portfolioManager.exportPortfolio();
              }
          });
      }
  });

  // Add token to portfolio function
  function addTokenToPortfolio() {
      console.log('Add token function called');
      console.log('Current user:', currentUser);
      
      const tokenSelect = document.getElementById('tokenSelect');
      const tokenAmount = document.getElementById('tokenAmount');
      const buyPrice = document.getElementById('buyPrice');

      const selectedToken = tokenSelect ? tokenSelect.value : null;
      const amount = tokenAmount ? tokenAmount.value : null;
      const price = buyPrice ? buyPrice.value : null;

      console.log('Token selection:', { selectedToken, amount, price });

      // Check if user is logged in
      if (!currentUser) {
          console.error('No user logged in');
          if (typeof portfolioManager !== 'undefined') {
              portfolioManager.showMessage('Please login to add tokens to your portfolio', 'error');
          }
          
          // Switch to login tab
          switchAuthTab('login');
          return;
      }

      if (!selectedToken) {
          if (typeof portfolioManager !== 'undefined') {
              portfolioManager.showMessage('Please select a token', 'error');
          }
          return;
      }

      if (!amount || parseFloat(amount) <= 0) {
          if (typeof portfolioManager !== 'undefined') {
              portfolioManager.showMessage('Please enter a valid amount', 'error');
          }
          return;
      }

      if (typeof portfolioManager !== 'undefined') {
          console.log('Calling portfolioManager.addHolding...');
          portfolioManager.addHolding(selectedToken, amount, price);
      } else {
          console.error('Portfolio manager not available');
          if (typeof portfolioManager !== 'undefined') {
              portfolioManager.showMessage('Portfolio system not available. Please refresh the page.', 'error');
          }
      }
  }

  // Enhanced theme management
  function initTheme() {
      const savedTheme = localStorage.getItem('tikstake_theme') || 
                        (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
      document.documentElement.setAttribute('data-theme', savedTheme);
      
      const themeToggle = document.getElementById('themeToggle');
      if (themeToggle) {
          const themeIcon = themeToggle.querySelector('.theme-icon');
          if (themeIcon) {
              themeIcon.textContent = savedTheme === 'dark' ? '☀️' : '🌙';
          }
          const textSpan = themeToggle.querySelector('span:last-child');
          if (textSpan) {
              textSpan.textContent = savedTheme === 'dark' ? 'Light' : 'Dark';
          }
      }
  }

  // Initialize theme
  initTheme();

  // Theme toggle handler
  document.getElementById('themeToggle')?.addEventListener('click', function() {
      const currentTheme = document.documentElement.getAttribute('data-theme') || 'light';
      const nextTheme = currentTheme === 'dark' ? 'light' : 'dark';
      const themeIcon = this.querySelector('.theme-icon');
      
      document.documentElement.setAttribute('data-theme', nextTheme);
      localStorage.setItem('tikstake_theme', nextTheme);
      
      if (themeIcon) {
          themeIcon.textContent = nextTheme === 'dark' ? '☀️' : '🌙';
      }
      
      const textSpan = this.querySelector('span:last-child');
      if (textSpan) {
          textSpan.textContent = nextTheme === 'dark' ? 'Light' : 'Dark';
      }
  });

  // Enhanced modal functionality with trade button fix
  document.addEventListener('DOMContentLoaded', function() {
      // Portfolio Modal
      const portfolioModal = document.getElementById("portfolioModal");
      const portfolioClose = portfolioModal ? portfolioModal.getElementsByClassName("close")[0] : null;

      if (portfolioClose) {
          portfolioClose.onclick = function() {
              portfolioModal.style.display = "none";
          }
      }

      // Trade Modal
      const tradeModal = document.getElementById("tradeModal");
      const tradeClose = tradeModal ? tradeModal.getElementsByClassName("close")[0] : null;

      if (tradeClose) {
          tradeClose.onclick = function() {
              tradeModal.style.display = "none";
          }
      }

      // Trade button handler - FIXED
      const tradeBtn = document.getElementById("tradeBtn");
      if (tradeBtn) {
          console.log('Trade button found, adding click handler');
          tradeBtn.addEventListener('click', function() {
              console.log('Trade button clicked');
              if (tradeModal) {
                  tradeModal.style.display = "block";
                  console.log('Trade modal opened');
              } else {
                  console.error('Trade modal not found');
              }
          });
      } else {
          console.error('Trade button not found');
      }

      // Close modals when clicking outside
      window.addEventListener('click', function(event) {
          if (event.target == portfolioModal) {
              portfolioModal.style.display = "none";
          }
          if (event.target == tradeModal) {
              tradeModal.style.display = "none";
          }
      });
  });
  </script>

  <!-- Real Firebase Counter with Proper Analytics -->
  <script type="module">
    import { initializeApp } from "https://www.gstatic.com/firebasejs/12.3.0/firebase-app.js";
    import { getFirestore, doc, setDoc, getDoc, updateDoc, increment, onSnapshot, collection, addDoc } from "https://www.gstatic.com/firebasejs/12.3.0/firebase-firestore.js";

    const firebaseConfig = {
      apiKey: "AIzaSyBCONg4JM9jtThFa6ClRJQO15qPIX7QGUw",
      authDomain: "tikstakememes.firebaseapp.com",
      projectId: "tikstakememes",
      storageBucket: "tikstakememes.appspot.com",
      messagingSenderId: "462788871293",
      appId: "1:462788871293:web:7ccd28b554760c04a09d14",
      measurementId: "G-KT99VHJ4LT"
    };

    try {
      const app = initializeApp(firebaseConfig);
      const db = getFirestore(app);
      const today = new Date().toISOString().slice(0, 10);
      const dailyRef = doc(db, "analytics", "daily");
      const todayVisitorRef = doc(db, "dailyCounts", today);

      console.log("Firebase analytics started for:", today);

      // Track visitor and update all counters
      async function trackVisitor() {
        try {
          const timestamp = new Date().toISOString();
          
          // 1. Add to visitor log
          await addDoc(collection(db, "visitorLog"), {
            timestamp: timestamp,
            date: today,
            userAgent: navigator.userAgent
          });

          // 2. Update daily counter
          const dailySnap = await getDoc(todayVisitorRef);
          if (dailySnap.exists()) {
            await updateDoc(todayVisitorRef, {
              realCount: increment(1),
              lastUpdated: timestamp
            });
          } else {
            await setDoc(todayVisitorRef, {
              realCount: 1,
              date: today,
              created: timestamp
            });
          }

          // 3. Update overall analytics
          const analyticsSnap = await getDoc(dailyRef);
          if (analyticsSnap.exists()) {
            await updateDoc(dailyRef, {
              totalVisitors: increment(1),
              lastUpdated: timestamp
            });
          } else {
            await setDoc(dailyRef, {
              totalVisitors: 1,
              created: timestamp
            });
          }

          console.log("Visitor tracked successfully");

        } catch (error) {
          console.error("Tracking error:", error);
        }
      }

      // Real-time listener for today's count
      onSnapshot(todayVisitorRef, (snap) => {
        if (snap.exists()) {
          const data = snap.data();
          const realCount = data.realCount || 0;
          const displayCount = 50 + realCount; // Fake 50 + real count
          document.getElementById("statusText").textContent = `Connected (Visitors today: ${displayCount})`;
        } else {
          document.getElementById("statusText").textContent = "Connected (Visitors today: 50)";
        }
      });

      // Track this visitor
      trackVisitor();

    } catch (error) {
      console.error("Firebase failed:", error);
      document.getElementById("statusText").textContent = "Connected";
    }
  </script>
</body>
</html>