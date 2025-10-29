// ---------- Config: curated lists ----------
const popularPairs = [
  '879F697iuDJGMevRkRcnW21fcXiAeLJK1ffsw2ATebce',//mew
  'GH8Ers4yzKR3UKDvgVu8cqJfGzU4cU62mTeg9bcJ7ug6', // $michi
  'HYpXCaAT9YBu7vYa5BURGprsa23hmvdkqXtSUD5gQWdc',//mini
  '3ne4mWqdYuNiYrYZC9TrA3FcfuFdErghH97vNPbjicr1', //bonk
  'EP2ib6dYdEeqD8MfE2ezHCxX3kP3K2eLKkirfPm5eyMx',  // wif
  'YrrUStgPugDp8BbfosqDeFssen6sA75ZS1QJvgnHtmY', // launchcoin
  'FAqh648xeeaTqL7du49sztp9nfj5PjRQrfvaMccyd9cz', // pengu
  '4AZRPNEfCJ7iw28rJu5aUyeQhYcvdcNm8cswyL51AY9i', // pnut
  '9t1H1uDJ558iMPNkEPSN1fqkpC4XSPQ6cqSf6uEsTfTR', // spx
  '8WwcNqdZjCY5Pt7AkhupAFknV2txca9sq6YBkGzLbvdt', // pippin
  'FRhB8L7Y9Qq41qZXYLtC2nw8An1RJfLLxRF2x9RwLLMo', // popcat
  '9ViX1VductEoC2wERTSp2TuDxXPwAf69aeET8ENPJpsN', // aura
  '4w2cysotX6czaUGmmWg13hDpY4QEMG2CzeKYEQyK9Ama', // troll
];

const newPairs = [
  'G6XZu9m4yAmoW1uGFKcAHUW5ufpURBk4kCeWr9dP1KxJ',//LLM
  '83G6VzJzLRCnHBsLATj94VCpRimyyqwuN6ZfL11McADL',//nub
  'BuX9TN5doE5hCqpcmqMKYkidXC8zgBK5wHHKujdaAbiQ',//RYS
  '4w2cysotX6czaUGmmWg13hDpY4QEMG2CzeKYEQyK9Ama',// Troll
  '7ccKzmrXBpFHwyZGPqPuKL6bEyWAETSnHwnWe3jEneVc',//uranus
  '8oopi6gVFh4FA1mL5Jj35yRetfpmWiUDTfhCv31gkA3v',//shitcoin
  '5wNu5QhdpRGrL37ffcd6TMMqZugQgxwafgz477rShtHy',//neet
'UKSPrYDU4veB4cAfV9HkzNg9gNP1jsoch8oySMG9tcJ',//fartless
'Q2sPHPdUWFMg7M7wwrQKLrn619cAucfRsmhVJffodSp',//useless
  '2CotF9J6Q6FMXq9igZmer6iHd6w8pWBD6dtnzMWzNbr3',//buidl
];

const highRiskPairs = [
  '9czr2MVyxgPCnDrbA7ywaqG3K1fgCkCQYbwSBKxnMJFS', // homo
  'KSeAucEoqTBB4ttakHYE1encbxjn2u9zUa9ursDLe1E', // supercycle
  '6HfaJiUuTXFZEfmdkQSNbvfe6i95Nh2wUVJ5dWMf7gtw',//retire
  '6GDrReNVfyjQDCuGMrKdG2JU7Uj8NCvBt2ukaL2mDj1L',//wojak
  'EPVwQEJCnenVSNYECMA2955BGTqJk2ptXuggrvtiFFG2',//momo
  'F1FMsNYuCNRHTDVjSkNbiZLp4qv6r6oQyMRJM9ZYdkm3',//stupid coin
];

// Updated data structure with both date and listing price
const tokenListingData = {
  '879F697iuDJGMevRkRcnW21fcXiAeLJK1ffsw2ATebce': { date: '2025-10-13', price: 0.002 }, // mew
  'BuX9TN5doE5hCqpcmqMKYkidXC8zgBK5wHHKujdaAbiQ': { date: '2025-10-05', price: 0.0001 }, // RYS
  '6HfaJiUuTXFZEfmdkQSNbvfe6i95Nh2wUVJ5dWMf7gtw': { date: '2025-09-20', price: 0.00015 },
  '3ne4mWqdYuNiYrYZC9TrA3FcfuFdErghH97vNPbjicr1': { date: '2025-08-16', price: 0.00002345 },//bonk
  'EP2ib6dYdEeqD8MfE2ezHCxX3kP3K2eLKkirfPm5eyMx': { date: '2025-05-06', price: 0.5520 },//wif
  'YrrUStgPugDp8BbfosqDeFssen6sA75ZS1QJvgnHtmY': { date: '2025-08-22', price: 0.04871 }, //launchcoin
  'FAqh648xeeaTqL7du49sztp9nfj5PjRQrfvaMccyd9cz': { date: '2025-07-06', price: 0.01605 },//pengu
  '4AZRPNEfCJ7iw28rJu5aUyeQhYcvdcNm8cswyL51AY9i': { date: '2025-05-25', price: 0.01705 },//pnut
  '9t1H1uDJ558iMPNkEPSN1fqkpC4XSPQ6cqSf6uEsTfTR': { date: '2025-05-31', price: 0.9985 },//spx
  '8WwcNqdZjCY5Pt7AkhupAFknV2txca9sq6YBkGzLbvdt': { date: '2024-05-22', price: 0.0015 },
  'FRhB8L7Y9Qq41qZXYLtC2nw8An1RJfLLxRF2x9RwLLMo': { date: '2025-04-25', price: 0.2536 },//popcat
  '9ViX1VductEoC2wERTSp2TuDxXPwAf69aeET8ENPJpsN': { date: '2025-09-30', price: 0.05950 },//aura
  '4w2cysotX6czaUGmmWg13hDpY4QEMG2CzeKYEQyK9Ama': { date: '2025-07-26', price: 0.01702 },//troll
  '9czr2MVyxgPCnDrbA7ywaqG3K1fgCkCQYbwSBKxnMJFS': { date: '2025-09-24', price: 0.00012 },
  '6GDrReNVfyjQDCuGMrKdG2JU7Uj8NCvBt2ukaL2mDj1L': { date: '2025-09-24', price: 0.00018 },
  'EPVwQEJCnenVSNYECMA2955BGTqJk2ptXuggrvtiFFG2': { date: '2025-09-24', price: 0.00022 },
  '7ccKzmrXBpFHwyZGPqPuKL6bEyWAETSnHwnWe3jEneVc': { date: '2025-09-30', price: 0.00035 },
  '8oopi6gVFh4FA1mL5Jj35yRetfpmWiUDTfhCv31gkA3v': { date: '2025-09-30', price: 0.00028 },
  '5wNu5QhdpRGrL37ffcd6TMMqZugQgxwafgz477rShtHy': { date: '2025-09-30', price: 0.00042 },
  'UKSPrYDU4veB4cAfV9HkzNg9gNP1jsoch8oySMG9tcJ': { date: '2025-09-30', price: 0.00019 },
  'Q2sPHPdUWFMg7M7wwrQKLrn619cAucfRsmhVJffodSp': { date: '2025-09-30', price: 0.00031 },
  '83G6VzJzLRCnHBsLATj94VCpRimyyqwuN6ZfL11McADL': { date: '2025-10-06', price: 0.00038 },
  'G6XZu9m4yAmoW1uGFKcAHUW5ufpURBk4kCeWr9dP1KxJ': { date: '2025-10-06', price: 0.00052 },
  'GH8Ers4yzKR3UKDvgVu8cqJfGzU4cU62mTeg9bcJ7ug6': { date: '2025-10-06', price: 0.01849 },
  'HYpXCaAT9YBu7vYa5BURGprsa23hmvdkqXtSUD5gQWdc':{ date: '2025-10-06', price: 0.009695 },
  '2CotF9J6Q6FMXq9igZmer6iHd6w8pWBD6dtnzMWzNbr3':{ date: '2025-10-08', price: 0.001645 }, //buidl
  'F1FMsNYuCNRHTDVjSkNbiZLp4qv6r6oQyMRJM9ZYdkm3' :{ date: '2025-10-08', price: 0.001453},//stupid coin
];

// ---------- Percentage Calculation Function ----------
function calculatePercentageRise(currentPrice, listingPrice) {
  if (!currentPrice || !listingPrice || listingPrice === 0) return null;
  const percentage = ((currentPrice - listingPrice) / listingPrice) * 100;
  return percentage;
}

// ---------- Enhanced Authentication Manager ----------
class AuthManager {
    constructor() {
        this.currentUser = null;
    }

    async checkAuthStatus() {
        try {
            const response = await fetch('./auth.php?action=check');
            const data = await response.json();
            
            if (data.success && data.authenticated) {
                this.currentUser = data.user;
                this.updateUI(true);
                return true;
            } else {
                this.currentUser = null;
                this.updateUI(false);
                return false;
            }
        } catch (error) {
            console.error('Auth check failed:', error);
            this.currentUser = null;
            this.updateUI(false);
            return false;
        }
    }

    updateUI(isAuthenticated) {
        const portfolioBtn = document.getElementById('portfolioBtn');
        
        if (portfolioBtn) {
            if (isAuthenticated) {
                portfolioBtn.classList.add('authenticated');
                portfolioBtn.textContent = '📊 Portfolio';
            } else {
                portfolioBtn.classList.remove('authenticated');
                portfolioBtn.textContent = '📊 Portfolio Tracker';
            }
        }
    }

    async logout() {
        if (confirm('Are you sure you want to logout?')) {
            try {
                const response = await fetch('./auth.php?action=logout');
                const data = await response.json();
                
                if (data.success) {
                    this.currentUser = null;
                    this.updateUI(false);
                    window.location.reload();
                }
            } catch (error) {
                console.error('Logout failed:', error);
            }
        }
    }
}

const authManager = new AuthManager();

// ---------- Portfolio Manager ----------
class PortfolioManager {
    constructor() {
        this.holdings = {};
        this.availableTokens = new Map();
    }

    async loadPortfolioFromServer() {
        if (!currentUser) {
            console.log('No user logged in, skipping portfolio load');
            this.holdings = {};
            this.updatePortfolioUI();
            return;
        }

        try {
            console.log('Loading portfolio from server for user:', currentUser.id);
            const response = await fetch('./get_portfolio.php');
            const data = await response.json();
            console.log('Portfolio load response:', data);
            
            if (data.success) {
                this.holdings = data.holdings || {};
                console.log('Loaded portfolio holdings:', this.holdings);
                this.updatePortfolioUI();
            } else {
                console.error('Failed to load portfolio:', data.message);
                this.holdings = {};
                this.updatePortfolioUI();
            }
        } catch (error) {
            console.error('Error loading portfolio from server:', error);
            this.holdings = {};
            this.updatePortfolioUI();
        }
    }

    async addHolding(pairId, amount, buyPrice = null) {
        console.log('addHolding called with:', { pairId, amount, buyPrice, currentUser });
        
        // Check if user is logged in
        if (!currentUser) {
            this.showMessage('Please login to add tokens to portfolio', 'error');
            console.error('No currentUser when adding holding');
            return false;
        }

        const token = this.availableTokens.get(pairId);
        if (!token) {
            this.showMessage('Token not found in available list', 'error');
            console.error('Token not found:', pairId);
            return false;
        }

        // Validate inputs
        const parsedAmount = parseFloat(amount);
        const parsedBuyPrice = buyPrice ? parseFloat(buyPrice) : (token.price || 0);
        
        if (isNaN(parsedAmount) || parsedAmount <= 0) {
            this.showMessage('Please enter a valid amount greater than 0', 'error');
            return false;
        }

        if (isNaN(parsedBuyPrice) || parsedBuyPrice < 0) {
            this.showMessage('Please enter a valid buy price', 'error');
            return false;
        }

        const holding = {
            token: {
                name: token.name,
                symbol: token.symbol,
                pairId: token.pairId
            },
            amount: parsedAmount,
            buyPrice: parsedBuyPrice,
            currentPrice: token.price || parsedBuyPrice,
            timestamp: new Date().toISOString(),
            id: this.generateId()
        };

        if (!this.holdings[pairId]) {
            this.holdings[pairId] = [];
        }

        this.holdings[pairId].push(holding);
        
        console.log('Saving portfolio to server for user:', currentUser);
        console.log('Holdings to save:', this.holdings);
        
        // Save to server
        const success = await this.savePortfolioToServer();
        
        if (success) {
            // Clear form inputs
            const tokenAmount = document.getElementById('tokenAmount');
            const buyPriceInput = document.getElementById('buyPrice');
            if (tokenAmount) tokenAmount.value = '';
            if (buyPriceInput) buyPriceInput.value = '';
            
            this.updatePortfolioUI();
            this.showMessage('Token added to portfolio successfully!', 'success');
            return true;
        } else {
            // Remove from local if server save failed
            this.holdings[pairId].pop();
            if (this.holdings[pairId].length === 0) {
                delete this.holdings[pairId];
            }
            this.showMessage('Failed to save token to portfolio. Please try again.', 'error');
            return false;
        }
    }

    async removeHolding(pairId, holdingId) {
        if (!currentUser) {
            this.showMessage('Please login to manage portfolio', 'error');
            return false;
        }

        try {
            const response = await fetch('./remove_portfolio_item.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    holding_id: holdingId
                })
            });

            const result = await response.json();
            
            if (result.success) {
                if (this.holdings[pairId]) {
                    this.holdings[pairId] = this.holdings[pairId].filter(h => h.id !== holdingId && h.db_id !== holdingId);
                    if (this.holdings[pairId].length === 0) {
                        delete this.holdings[pairId];
                    }
                }
                
                this.updatePortfolioUI();
                this.showMessage('Token removed from portfolio', 'success');
                return true;
            } else {
                this.showMessage('Failed to remove token: ' + result.message, 'error');
                return false;
            }
        } catch (error) {
            console.error('Error removing holding:', error);
            this.showMessage('Error removing token', 'error');
            return false;
        }
    }

    async savePortfolioToServer() {
        if (!currentUser) {
            console.error('No user logged in, cannot save portfolio');
            return false;
        }

        try {
            const response = await fetch('./store_portfolio.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    holdings: this.holdings
                })
            });

            const result = await response.json();
            console.log('Portfolio save response:', result);
            
            if (result.success) {
                // Reload from server to get database IDs
                await this.loadPortfolioFromServer();
                return true;
            } else {
                this.showMessage('Failed to save portfolio: ' + result.message, 'error');
                return false;
            }
        } catch (error) {
            console.error('Error saving portfolio to server:', error);
            this.showMessage('Error saving portfolio', 'error');
            return false;
        }
    }

    async clearPortfolio() {
        if (!currentUser) {
            this.showMessage('Please login to manage portfolio', 'error');
            return;
        }

        if (confirm('Are you sure you want to clear your entire portfolio? This action cannot be undone.')) {
            this.holdings = {};
            const success = await this.savePortfolioToServer();
            
            if (success) {
                this.updatePortfolioUI();
                this.showMessage('Portfolio cleared successfully', 'success');
            } else {
                this.showMessage('Failed to clear portfolio. Please try again.', 'error');
                await this.loadPortfolioFromServer();
            }
        }
    }

    updateTokenPrices(currentPrices) {
        Object.keys(this.holdings).forEach(pairId => {
            if (currentPrices[pairId] !== undefined) {
                this.holdings[pairId].forEach(holding => {
                    holding.currentPrice = currentPrices[pairId];
                });
            }
        });
        this.savePortfolioToServer();
    }

    calculatePortfolioValue() {
        let totalValue = 0;
        let totalCost = 0;
        const performance = {};

        Object.entries(this.holdings).forEach(([pairId, holdings]) => {
            holdings.forEach(holding => {
                const currentPrice = holding.currentPrice || 0;
                const value = holding.amount * currentPrice;
                const cost = holding.amount * (holding.buyPrice || 0);
                const profitLoss = value - cost;
                const profitLossPercent = cost > 0 ? (profitLoss / cost) * 100 : 0;

                totalValue += value;
                totalCost += cost;

                if (!performance[pairId]) {
                    performance[pairId] = {
                        token: holding.token,
                        totalValue: 0,
                        totalCost: 0,
                        profitLoss: 0,
                        holdings: []
                    };
                }

                performance[pairId].totalValue += value;
                performance[pairId].totalCost += cost;
                performance[pairId].profitLoss += profitLoss;
                performance[pairId].holdings.push(holding);
            });
        });

        return {
            totalValue,
            totalCost,
            totalProfitLoss: totalValue - totalCost,
            totalProfitLossPercent: totalCost > 0 ? ((totalValue - totalCost) / totalCost) * 100 : 0,
            performance
        };
    }

    generateId() {
        return Date.now().toString(36) + Math.random().toString(36).substr(2);
    }

    exportPortfolio() {
        const portfolioData = {
            userInfo: currentUser,
            holdings: this.holdings,
            summary: this.calculatePortfolioValue(),
            exportDate: new Date().toISOString()
        };

        const dataStr = JSON.stringify(portfolioData, null, 2);
        const dataBlob = new Blob([dataStr], { type: 'application/json' });
        
        const link = document.createElement('a');
        link.href = URL.createObjectURL(dataBlob);
        link.download = `tikstake-portfolio-${currentUser.id}-${new Date().toISOString().split('T')[0]}.json`;
        link.click();
        
        this.showMessage('Portfolio exported successfully!', 'success');
    }

    initializeAvailableTokens() {
        this.availableTokens.clear();
        
        console.log('Initializing available tokens...');
        console.log('Popular tokens:', popularListings.length);
        console.log('New tokens:', newListings.length);
        console.log('High risk tokens:', highRiskListings.length);
        
        // Combine all token lists
        const allTokens = [...popularListings, ...newListings, ...highRiskListings];
        console.log('Total tokens found:', allTokens.length);
        
        allTokens.forEach(token => {
            if (token && token.pairId && token.name) {
                this.availableTokens.set(token.pairId, token);
                console.log('Added token:', token.name, token.pairId);
            }
        });
        
        console.log('Available tokens map size:', this.availableTokens.size);
    }

    populateTokenDropdown() {
        const tokenSelect = document.getElementById('tokenSelect');
        if (!tokenSelect) return;

        tokenSelect.innerHTML = '<option value="">Choose a token...</option>';
        
        this.availableTokens.forEach((token, pairId) => {
            const option = document.createElement('option');
            option.value = pairId;
            option.textContent = `${token.name} (${token.symbol}) - ${this.fmtPrice(token.price)}`;
            option.dataset.currentPrice = token.price || 0;
            tokenSelect.appendChild(option);
        });

        console.log('Token dropdown populated with', this.availableTokens.size, 'tokens');
    }

    updatePortfolioUI() {
        console.log('Updating portfolio UI with holdings:', this.holdings);
        
        const portfolioSummary = document.getElementById('portfolioSummary');
        const portfolioTableContainer = document.getElementById('portfolioTableContainer');
        const emptyPortfolio = document.getElementById('emptyPortfolio');
        const portfolioTableBody = document.getElementById('portfolioTableBody');

        const portfolioValue = this.calculatePortfolioValue();
        const hasHoldings = Object.keys(this.holdings).length > 0;

        console.log('Has holdings:', hasHoldings, 'Holdings count:', Object.keys(this.holdings).length);

        // Show/hide empty state
        if (emptyPortfolio) {
            emptyPortfolio.style.display = hasHoldings ? 'none' : 'block';
        }
        if (portfolioSummary) {
            portfolioSummary.style.display = hasHoldings ? 'block' : 'none';
        }
        if (portfolioTableContainer) {
            portfolioTableContainer.style.display = hasHoldings ? 'block' : 'none';
        }

        if (!hasHoldings) {
            console.log('No holdings to display');
            return;
        }

        // Update summary
        if (document.getElementById('totalValue')) {
            document.getElementById('totalValue').textContent = this.fmtMoney(portfolioValue.totalValue);
        }
        if (document.getElementById('totalProfitLoss')) {
            const profitLossElem = document.getElementById('totalProfitLoss');
            profitLossElem.textContent = this.fmtMoney(portfolioValue.totalProfitLoss);
            profitLossElem.className = `summary-value ${portfolioValue.totalProfitLoss >= 0 ? 'profit-positive' : 'profit-negative'}`;
        }
        if (document.getElementById('totalROI')) {
            const roiElem = document.getElementById('totalROI');
            const roiPercent = portfolioValue.totalProfitLossPercent;
            roiElem.textContent = `${roiPercent >= 0 ? '+' : ''}${roiPercent.toFixed(2)}%`;
            roiElem.className = `summary-value ${roiPercent >= 0 ? 'profit-positive' : 'profit-negative'}`;
        }

        // Update portfolio table
        if (portfolioTableBody) {
            portfolioTableBody.innerHTML = '';

            Object.entries(portfolioValue.performance).forEach(([pairId, tokenData]) => {
                tokenData.holdings.forEach(holding => {
                    const currentValue = holding.amount * (holding.currentPrice || 0);
                    const cost = holding.amount * (holding.buyPrice || 0);
                    const profitLoss = currentValue - cost;
                    const roi = cost > 0 ? (profitLoss / cost) * 100 : 0;

                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>
                            <strong>${holding.token.name}</strong><br>
                            <small class="muted">${holding.token.symbol}</small>
                        </td>
                        <td>${parseFloat(holding.amount).toLocaleString(undefined, {maximumFractionDigits: 6})}</td>
                        <td>${this.fmtPrice(holding.buyPrice)}</td>
                        <td>${this.fmtPrice(holding.currentPrice)}</td>
                        <td>${this.fmtMoney(currentValue)}</td>
                        <td class="${profitLoss >= 0 ? 'profit-positive' : 'profit-negative'}">
                            ${this.fmtMoney(profitLoss)}
                        </td>
                        <td class="${roi >= 0 ? 'profit-positive' : 'profit-negative'}">
                            ${roi >= 0 ? '+' : ''}${roi.toFixed(2)}%
                        </td>
                        <td>
                            <button class="btn btn-danger" style="padding: 6px 12px; font-size: 12px;" 
                                    onclick="portfolioManager.removeHolding('${pairId}', '${holding.db_id || holding.id}')">
                                Remove
                            </button>
                        </td>
                    `;
                    portfolioTableBody.appendChild(row);
                });
            });
            
            console.log('Portfolio table updated with', portfolioTableBody.children.length, 'rows');
        }
    }

    fmtPrice(n) {
        if (n === null || n === undefined || isNaN(n)) return '-';
        if (n === 0) return '$0';
        
        if (n >= 1) {
            return '$' + n.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 });
        }
        
        const priceStr = n.toString();
        
        if (n >= 0.0001) {
            let formatted = n.toFixed(6).replace(/\.?0+$/, '');
            if (!formatted.includes('.')) {
                formatted += '.00';
            } else if (formatted.split('.')[1].length < 2) {
                formatted += '0'.repeat(2 - formatted.split('.')[1].length);
            }
            return '$' + formatted;
        }
        
        const match = priceStr.match(/^0\.(0+)([1-9][0-9]*)/);
        
        if (match) {
            const zerosCount = match[1].length;
            const significantDigits = match[2].substring(0, 4);
            
            return `$0.0<sub>${zerosCount}</sub>${significantDigits}`;
        }
        
        return '$' + n.toExponential(4);
    }

    fmtMoney(n) {
        if (n === null || n === undefined || isNaN(n)) return '-';
        if (n >= 1_000_000_000) return '$' + (n / 1_000_000_000).toFixed(2) + 'B';
        if (n >= 1_000_000) return '$' + (n / 1_000_000).toFixed(2) + 'M';
        if (n >= 1_000) return '$' + (n / 1_000).toFixed(2) + 'K';
        return '$' + n.toFixed(2);
    }

    showMessage(message, type = 'info') {
        // Remove existing messages
        const existingMessages = document.querySelectorAll('.portfolio-message');
        existingMessages.forEach(msg => msg.remove());

        const messageDiv = document.createElement('div');
        messageDiv.className = `auth-message ${type} portfolio-message`;
        messageDiv.textContent = message;

        const portfolioContent = document.getElementById('portfolioContent');
        if (portfolioContent) {
            portfolioContent.insertBefore(messageDiv, portfolioContent.firstChild);
            
            // Auto remove after 5 seconds
            setTimeout(() => {
                if (messageDiv.parentNode) {
                    messageDiv.remove();
                }
            }, 5000);
        }
    }
}

const portfolioManager = new PortfolioManager();

// ---------- Database Storage Functions ----------
class DatabaseManager {
    constructor() {
        this.baseUrl = './';
    }

    async storeTokens(tokens, category) {
        try {
            const response = await fetch(this.baseUrl + 'store_tokens.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    tokens: tokens,
                    category: category
                })
            });

            const result = await response.json();
            console.log(`Stored ${category} tokens:`, result);
            return result;
        } catch (error) {
            console.error('Error storing tokens in database:', error);
            return { success: false, error: error.message };
        }
    }

    async getTokens(category = 'all') {
        try {
            const response = await fetch(`${this.baseUrl}get_tokens.php?category=${category}`);
            const result = await response.json();
            return result;
        } catch (error) {
            console.error('Error fetching tokens from database:', error);
            return { success: false, error: error.message };
        }
    }

    async getTokenStats() {
        try {
            const response = await fetch(this.baseUrl + 'get_token_stats.php');
            const result = await response.json();
            return result;
        } catch (error) {
            console.error('Error fetching token stats:', error);
            return { success: false, error: error.message };
        }
    }

    prepareTokenData(tokens, category) {
        return tokens.map(token => ({
            pairId: token.pairId,
            name: token.name,
            symbol: token.symbol,
            price: token.price,
            volume: token.volume,
            change: token.change,
            liquidityUsd: token.liquidityUsd,
            marketCap: token.marketCap,
            tokenAddress: token.tokenAddress,
            addedDate: token.addedDate,
            listingPrice: token.listingPrice,
            category: category
        }));
    }
}

const dbManager = new DatabaseManager();

// ---------- Enhanced Price Formatting ----------
const fmtPrice = (n) => {
  if (n === null || n === undefined || isNaN(n)) return '-';
  if (n === 0) return '$0';
  
  if (n >= 1) {
    return '$' + n.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 });
  }
  
  const priceStr = n.toString();
  
  if (n >= 0.0001) {
    let formatted = n.toFixed(6).replace(/\.?0+$/, '');
    if (!formatted.includes('.')) {
      formatted += '.00';
    } else if (formatted.split('.')[1].length < 2) {
      formatted += '0'.repeat(2 - formatted.split('.')[1].length);
    }
    return '$' + formatted;
  }
  
  const match = priceStr.match(/^0\.(0+)([1-9][0-9]*)/);
  
  if (match) {
    const zerosCount = match[1].length;
    const significantDigits = match[2].substring(0, 4);
    
    return `$0.0<sub>${zerosCount}</sub>${significantDigits}`;
  }
  
  return '$' + n.toExponential(4);
};

// ---------- Formatting helpers ----------

const fmtChange = (n) => {
  if (n === null || n === undefined || isNaN(n)) return '-';
  const sign = n > 0 ? '+' : '';
  const className = n >= 0 ? 'change-positive' : 'change-negative';
  return `<span class="${className}">${sign}${n.toFixed(2)}%</span>`;
};

const fmtMoney = (n) => {
  if (n === null || n === undefined || isNaN(n)) return '-';
  if (n >= 1_000_000_000) return '$' + (n / 1_000_000_000).toFixed(2) + 'B';
  if (n >= 1_000_000) return '$' + (n / 1_000_000).toFixed(2) + 'M';
  if (n >= 1_000) return '$' + (n / 1_000).toFixed(2) + 'K';
  return '$' + n.toFixed(0);
};

const shortenAddress = (addr) => (addr ? `${addr.slice(0, 6)}...${addr.slice(-6)}` : '-');

// ---------- Data state ----------
let popularListings = [];
let newListings = [];
let highRiskListings = [];
let lastUpdated = null;
let autoRefreshInterval = null;

// ---------- Dexscreener fetch with improved error handling ----------
async function fetchDexToken(pairId) {
  const url = `https://api.dexscreener.com/latest/dex/pairs/solana/${pairId}`;
  try {
    const res = await fetch(url);
    if (!res.ok) throw new Error('Dexscreener fetch failed');
    const data = await res.json();
    const p = data?.pair;
    if (!p) throw new Error('Pair not found');

    const listingData = tokenListingData[pairId] || { date: 'Unknown', price: null };
    
    const currentPrice = p.priceUsd ? parseFloat(p.priceUsd) : null;
    const percentageSinceListing = calculatePercentageRise(currentPrice, listingData.price);

    return {
      pairId,
      addedDate: listingData.date,
      listingPrice: listingData.price,
      percentageSinceListing,
      name: p.baseToken?.name || 'Unknown',
      symbol: p.baseToken?.symbol || '',
      price: currentPrice,
      volume: p.volume?.h24 ? parseFloat(p.volume.h24) : 0,
      change: p.priceChange?.h24 ? parseFloat(p.priceChange.h24) : 0,
      tokenAddress: p.baseToken?.address,
      liquidityUsd: p.liquidity?.usd ? Number(p.liquidity.usd) : null,
      marketCap: p.marketCap != null ? Number(p.marketCap) : (p.fdv != null ? Number(p.fdv) : null)
    };
  } catch (error) {
    console.error('Error fetching token data:', error);
    const listingData = tokenListingData[pairId] || { date: 'Unknown', price: null };
    
    return {
      pairId,
      addedDate: listingData.date,
      listingPrice: listingData.price,
      percentageSinceListing: null,
      name: 'Error',
      symbol: 'ERR',
      price: null,
      volume: 0,
      change: 0,
      tokenAddress: null,
      liquidityUsd: null,
      marketCap: null
    };
  }
}

// ---------- Rendering with improved filtering ----------
function renderTable(array, containerId, withSearchSort, isHighRisk = false) {
  const tbody = document.getElementById(containerId);
  if (!tbody) return;

  let rows = [...array];

  if (withSearchSort) {
    const searchId = isHighRisk ? 'highriskSearchInput' : 'searchInput';
    const sortId = isHighRisk ? 'highriskSortSelect' : 'sortSelect';
    const filterId = isHighRisk ? 'highriskFilterSelect' : 'filterSelect';
    
    const search = (document.getElementById(searchId)?.value || '').toLowerCase();
    const sort = document.getElementById(sortId)?.value || '';
    const filter = document.getElementById(filterId)?.value || '';

    rows = rows.filter(t =>
      t.name.toLowerCase().includes(search) || 
      t.symbol.toLowerCase().includes(search)
    );

    if (filter === 'gainers') rows = rows.filter(t => t.change > 0);
    if (filter === 'losers') rows = rows.filter(t => t.change < 0);

    if (sort === 'price') rows.sort((a, b) => (b.price || 0) - (a.price || 0));
    if (sort === 'volume') rows.sort((a, b) => b.volume - a.volume);
    if (sort === 'change') rows.sort((a, b) => b.change - a.change);
    if (sort === 'liquidity') rows.sort((a, b) => (b.liquidityUsd || 0) - (a.liquidityUsd || 0));
    if (sort === 'marketCap') rows.sort((a, b) => (b.marketCap || 0) - (a.marketCap || 0));
  }

  if (rows.length === 0) {
    tbody.innerHTML = '<tr><td colspan="7" style="text-align: center;">No tokens found</td></tr>';
    return;
  }

tbody.innerHTML = rows.map(t => `
  <tr onclick="openChart('${t.pairId}')">
    <td>${t.name}</td>
    <td><strong>${t.symbol}</strong></td>
    <td class="price-cell">${fmtPrice(t.price)}</td>
    <td>$${(t.volume || 0).toLocaleString()}</td>
    <td>${fmtChange(t.change)}</td>
    <td>${t.liquidityUsd != null ? fmtMoney(t.liquidityUsd) : '-'}</td>
    <td>${t.marketCap != null ? fmtMoney(t.marketCap) : '-'}</td>
  </tr>
`).join('');
}

// ---------- Full Screen Chart Page ----------
function openChart(pairId) {
  const t = [...popularListings, ...newListings, ...highRiskListings].find(x => x.pairId === pairId);
  if (!t) return;

  const theme = document.documentElement.getAttribute('data-theme') || 'dark';
  const chartUrl = `https://www.dextools.io/widget-chart/en/solana/pe-light/${pairId}?theme=${theme}&chartType=1`;
  const solscanUrl = t.tokenAddress ? `https://solscan.io/token/${t.tokenAddress}` : '#';

  const html = `
    <html>
      <head>
        <title>${t.name} (${t.symbol})</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
          * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
          }
          
          body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            background: ${theme === 'dark' ? '#0b1020' : '#f9f9f9'};
            color: ${theme === 'dark' ? '#e6e7ea' : '#222'};
            min-height: 100vh;
            overflow: hidden;
          }
          
          .app-container {
            display: flex;
            flex-direction: column;
            height: 100vh;
            transition: all 0.3s ease;
          }
          
          .normal-mode {
            padding: 15px;
            overflow-y: auto;
            flex: 1;
          }
          
          .container {
            max-width: 1200px;
            margin: 0 auto;
          }
          
          .header-controls {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
            flex-wrap: wrap;
          }
          
          .back-button, .fullscreen-button {
            padding: 12px 18px;
            background: ${theme === 'dark' ? '#1f2937' : '#111827'};
            color: ${theme === 'dark' ? '#e6e7ea' : '#fff'};
            border: none;
            border-radius: 8px;
            font-weight: 500;
            font-size: 14px;
            cursor: pointer;
            transition: background 0.2s;
          }
          
          .fullscreen-button {
            background: ${theme === 'dark' ? '#3b82f6' : '#2563eb'};
          }
          
          .back-button:hover, .fullscreen-button:hover {
            opacity: 0.9;
          }
          
          .token-header {
            margin-bottom: 20px;
          }
          
          .token-title {
            font-size: 1.5rem;
            margin-bottom: 10px;
            color: ${theme === 'dark' ? '#e6e7ea' : '#222'};
          }
          
          .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 12px;
            margin-bottom: 20px;
          }
          
          .info-card {
            background: ${theme === 'dark' ? '#0f172a' : '#fff'};
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            border: 1px solid ${theme === 'dark' ? '#374151' : '#e5e7eb'};
          }
          
          .info-card strong {
            display: block;
            margin-bottom: 5px;
            font-size: 0.9rem;
            color: ${theme === 'dark' ? '#9ca3af' : '#6b7280'};
          }
          
          .info-card span {
            font-size: 1rem;
            font-weight: 600;
          }
          
          .listing-info {
            background: ${theme === 'dark' ? '#0f172a' : '#fff'};
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            border: 1px solid ${theme === 'dark' ? '#374151' : '#e5e7eb'};
          }
          
          .listing-info strong {
            display: block;
            margin-bottom: 8px;
            color: ${theme === 'dark' ? '#9ca3af' : '#6b7280'};
          }
          
          .listing-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 10px;
          }
          
          .listing-item {
            padding: 8px;
            border-radius: 6px;
            background: ${theme === 'dark' ? '#1e293b' : '#f8fafc'};
          }
          
          .listing-item strong {
            font-size: 0.8rem;
            color: ${theme === 'dark' ? '#94a3b8' : '#64748b'};
          }
          
          .listing-item span {
            font-size: 0.9rem;
            font-weight: 600;
          }
          
          .percentage-positive {
            color: #10b981;
          }
          
          .percentage-negative {
            color: #ef4444;
          }
          
          .address-section {
            background: ${theme === 'dark' ? '#0f172a' : '#fff'};
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            border: 1px solid ${theme === 'dark' ? '#374151' : '#e5e7eb'};
          }
          
          .address-section strong {
            display: block;
            margin-bottom: 8px;
            color: ${theme === 'dark' ? '#9ca3af' : '#6b7280'};
          }
          
          .address-link {
            color: ${theme === 'dark' ? '#60a5fa' : '#3b82f6'};
            text-decoration: none;
            word-break: break-all;
            font-family: monospace;
            font-size: 0.9rem;
          }
          
          .chart-container {
            width: 100%;
            margin-bottom: 20px;
            flex: 1;
          }
          
          .chart-iframe {
            width: 100%;
            border: 1px solid ${theme === 'dark' ? '#374151' : '#ddd'};
            border-radius: 8px;
            background: ${theme === 'dark' ? '#0b1020' : '#fff'};
          }
          
          body.fullscreen-mode {
            overflow: hidden;
          }
          
          .fullscreen-mode .app-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            z-index: 10000;
            background: ${theme === 'dark' ? '#0b1020' : '#f9f9f9'};
          }
          
          .fullscreen-mode .normal-mode {
            display: none;
          }
          
          .fullscreen-mode .fullscreen-container {
            display: block;
            width: 100vw;
            height: 100vh;
            position: relative;
          }
          
          .fullscreen-mode .fullscreen-chart {
            width: 100vw;
            height: 100vh;
            border: none;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 10001;
          }
          
          .fullscreen-controls {
            display: none;
            position: fixed;
            top: 15px;
            right: 15px;
            z-index: 10002;
          }
          
          .fullscreen-mode .fullscreen-controls {
            display: block;
          }
          
          .exit-fullscreen-button {
            padding: 8px 12px;
            background: rgba(0, 0, 0, 0.7);
            color: white;
            border: none;
            border-radius: 6px;
            font-weight: 500;
            font-size: 12px;
            cursor: pointer;
            backdrop-filter: blur(10px);
            transition: all 0.2s;
          }
          
          .exit-fullscreen-button:hover {
            background: rgba(0, 0, 0, 0.9);
            transform: scale(1.05);
          }
          
          .fullscreen-container {
            display: none;
          }
          
          @media (max-width: 768px) {
            .normal-mode {
              padding: 10px;
            }
            
            .token-title {
              font-size: 1.3rem;
            }
            
            .info-grid {
              grid-template-columns: 1fr 1fr;
              gap: 10px;
            }
            
            .info-card {
              padding: 12px;
            }
            
            .info-card strong {
              font-size: 0.8rem;
            }
            
            .info-card span {
              font-size: 0.9rem;
            }
            
            .listing-details {
              grid-template-columns: 1fr;
            }
            
            .listing-item {
              padding: 6px;
            }
            
            .header-controls {
              flex-direction: column;
            }
            
            .back-button, .fullscreen-button {
              width: 100%;
              text-align: center;
            }
            
            .chart-iframe {
              height: 400px;
            }
            
            .address-section, .listing-info {
              padding: 12px;
            }
            
            .fullscreen-controls {
              top: 10px;
              right: 10px;
            }
            
            .exit-fullscreen-button {
              padding: 6px 10px;
              font-size: 11px;
            }
          }
          
          @media (max-width: 480px) {
            .info-grid {
              grid-template-columns: 1fr;
            }
            
            .chart-iframe {
              height: 350px;
            }
          }
          
          @media (min-width: 769px) {
            .chart-iframe {
              height: 500px;
            }
          }
        </style>
      </head>
      <body>
        <div class="app-container">
          <div class="normal-mode" id="normalMode">
            <div class="container">
              <div class="header-controls">
                <button class="back-button" onclick="window.close()">← Close Chart</button>
                <button class="fullscreen-button" onclick="enterFullscreen()">📈 Full Screen Chart</button>
              </div>
              
              <div class="token-header">
                <h1 class="token-title">${t.name} (${t.symbol})</h1>
              </div>
              
              <div class="info-grid">
                <div class="info-card">
                  <strong>Current Price</strong>
                  <span>${fmtPrice(t.price)}</span>
                </div>
                <div class="info-card">
                  <strong>Liquidity</strong>
                  <span>${t.liquidityUsd != null ? '$' + t.liquidityUsd.toLocaleString() : '-'}</span>
                </div>
                <div class="info-card">
                  <strong>Market Cap</strong>
                  <span>${t.marketCap != null ? '$' + t.marketCap.toLocaleString() : '-'}</span>
                </div>
                <div class="info-card">
                  <strong>24h Change</strong>
                  <span>${fmtChange(t.change)}</span>
                </div>
              </div>
              
              <div class="listing-info">
                <strong>Listing Information</strong>
                <div class="listing-details">
                  <div class="listing-item">
                    <strong>Listed Date</strong>
                    <span>${t.addedDate}</span>
                  </div>
                  <div class="listing-item">
                    <strong>Listing Price</strong>
                    <span>${t.listingPrice ? fmtPrice(t.listingPrice) : 'Unknown'}</span>
                  </div>
                  <div class="listing-item">
                    <strong>Performance Since Listing</strong>
                    <span class="${t.percentageSinceListing >= 0 ? 'percentage-positive' : 'percentage-negative'}">
                      ${t.percentageSinceListing !== null ? 
                        (t.percentageSinceListing >= 0 ? '+' : '') + t.percentageSinceListing.toFixed(2) + '%' : 
                        'N/A'}
                    </span>
                  </div>
                </div>
              </div>
              
              ${t.tokenAddress ? `
              <div class="address-section">
                <strong>Mint Address</strong>
                <a href="${solscanUrl}" target="_blank" class="address-link">
                  ${shortenAddress(t.tokenAddress)}
                </a>
              </div>
              ` : ''}
              
              <div class="chart-container">
                <iframe 
                  src="${chartUrl}" 
                  class="chart-iframe"
                  frameborder="0"
                  allowfullscreen>
                </iframe>
              </div>
            </div>
          </div>
          
          <div class="fullscreen-container" id="fullscreenContainer">
            <iframe 
              src="${chartUrl}" 
              class="fullscreen-chart"
              frameborder="0"
              allowfullscreen>
            </iframe>
          </div>
          
          <div class="fullscreen-controls" id="fullscreenControls">
            <button class="exit-fullscreen-button" onclick="exitFullscreen()">✕ Exit</button>
          </div>
        </div>
        
        <script>
          let isFullscreen = false;
          
          function enterFullscreen() {
            const body = document.body;
            const fullscreenContainer = document.getElementById('fullscreenContainer');
            const fullscreenControls = document.getElementById('fullscreenControls');
            
            body.classList.add('fullscreen-mode');
            fullscreenContainer.style.display = 'block';
            fullscreenControls.style.display = 'block';
            document.body.style.overflow = 'hidden';
            isFullscreen = true;
            console.log('Entered fullscreen mode');
          }
          
          function exitFullscreen() {
            const body = document.body;
            const fullscreenContainer = document.getElementById('fullscreenContainer');
            const fullscreenControls = document.getElementById('fullscreenControls');
            
            body.classList.remove('fullscreen-mode');
            fullscreenContainer.style.display = 'none';
            fullscreenControls.style.display = 'none';
            document.body.style.overflow = 'auto';
            isFullscreen = false;
            console.log('Exited fullscreen mode');
          }
          
          document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape' && isFullscreen) {
              exitFullscreen();
            }
          });
          
          function isMobile() {
            return window.innerWidth <= 768;
          }
          
          function adjustIframeHeight() {
            if (!isFullscreen) {
              const iframe = document.querySelector('.chart-iframe');
              if (iframe && isMobile()) {
                iframe.style.height = Math.min(window.innerHeight * 0.6, 500) + 'px';
              }
            }
          }
          
          window.addEventListener('resize', adjustIframeHeight);
          window.addEventListener('load', adjustIframeHeight);
          
          document.querySelector('.back-button').addEventListener('click', function() {
            window.close();
          });
        </script>
      </body>
    </html>
  `;

  const w = window.open('', '_blank');
  if (!w) {
    alert('Popup blocked. Please allow popups for this site.');
    return;
  }
  w.document.write(html);
  w.document.close();
}

// ---------- Enhanced Loading Functions with Database Storage ----------
async function loadPopularTokens() {
  const tbody = document.getElementById('popular-tokens');
  if (tbody) tbody.innerHTML = '<tr><td colspan="7" class="loading">Loading popular tokens...</td></tr>';
  
  popularListings = [];
  for (const pid of popularPairs) {
    try {
      const t = await fetchDexToken(pid);
      popularListings.push(t);
    } catch (e) {
      console.warn('Failed to load popular pair:', pid, e);
    }
  }
  
  // Store in database
  const dbTokens = dbManager.prepareTokenData(popularListings, 'popular');
  await dbManager.storeTokens(dbTokens, 'popular');
  
  renderTable(popularListings, 'popular-tokens', false);
  updateLastUpdated();
  updatePortfolioPrices();
}

async function loadNewTokens() {
  const tbody = document.getElementById('new-tokens');
  if (tbody) tbody.innerHTML = '<tr><td colspan="7" class="loading">Loading new tokens...</td></tr>';
  
  newListings = [];
  for (const pid of newPairs) {
    try {
      const t = await fetchDexToken(pid);
      newListings.push(t);
    } catch (e) {
      console.warn('Failed to load new pair:', pid, e);
    }
  }
  
  // Store in database
  const dbTokens = dbManager.prepareTokenData(newListings, 'new');
  await dbManager.storeTokens(dbTokens, 'new');
  
  renderTable(newListings, 'new-tokens', true);
  updateLastUpdated();
  updatePortfolioPrices();
}

async function loadHighRiskTokens() {
  const tbody = document.getElementById('highrisk-tokens');
  if (tbody) tbody.innerHTML = '<tr><td colspan="7" class="loading">Loading high risk tokens...</td></tr>';
  
  highRiskListings = [];
  for (const pid of highRiskPairs) {
    try {
      const t = await fetchDexToken(pid);
      highRiskListings.push(t);
    } catch (e) {
      console.warn('Failed to load high risk pair:', pid, e);
    }
  }
  
  // Store in database
  const dbTokens = dbManager.prepareTokenData(highRiskListings, 'high_risk');
  await dbManager.storeTokens(dbTokens, 'high_risk');
  
  renderTable(highRiskListings, 'highrisk-tokens', true, true);
  updateLastUpdated();
  updatePortfolioPrices();
}

function updateLastUpdated() {
  lastUpdated = new Date();
  const elem = document.getElementById('lastUpdated');
  if (elem) {
    elem.textContent = lastUpdated.toLocaleTimeString();
  }
}

function updatePortfolioPrices() {
    // Create a map of current prices for all tokens
    const currentPrices = {};
    
    [...popularListings, ...newListings, ...highRiskListings].forEach(token => {
        if (token && token.pairId && token.price !== null) {
            currentPrices[token.pairId] = token.price;
        }
    });
    
    // Update portfolio manager with current prices
    if (typeof portfolioManager !== 'undefined') {
        portfolioManager.updateTokenPrices(currentPrices);
    }
}

function refreshAll() {
  loadPopularTokens();
  loadNewTokens();
  loadHighRiskTokens();
}

// Connection status monitoring
function monitorConnection() {
  const statusElem = document.getElementById('connectionStatus');
  const dotElem = statusElem.querySelector('.status-dot');
  const textElem = document.getElementById('statusText');
  
  function updateStatus(online) {
    if (online) {
      dotElem.className = 'status-dot online';
      statusElem.style.background = 'var(--card)';
    } else {
      dotElem.className = 'status-dot offline';
      textElem.textContent = 'Offline - Data may be outdated';
      statusElem.style.background = 'var(--change-negative)';
      statusElem.style.color = 'white';
    }
  }
  
  updateStatus(navigator.onLine);
  
  window.addEventListener('online', () => updateStatus(true));
  window.addEventListener('offline', () => updateStatus(false));
}

// Database Status Display
function setupDatabaseStatus() {
  const statusElement = document.getElementById('connectionStatus');
  if (!statusElement) return;

  // Check database connection
  dbManager.getTokenStats().then(stats => {
    if (stats.success) {
      const statusText = document.getElementById('statusText');
      if (statusText) {
        statusText.innerHTML = `Connected • DB: ${stats.stats.total_tokens} tokens`;
      }
    }
  }).catch(error => {
    console.log('Database not available, using local storage only');
  });
}

// Setup auto refresh
function setupAutoRefresh() {
  if (autoRefreshInterval) {
    clearInterval(autoRefreshInterval);
  }
  
  autoRefreshInterval = setInterval(() => {
    refreshAll();
  }, 120000);
}

// Setup portfolio event listeners
function setupPortfolioEventListeners() {
    console.log('Setting up portfolio event listeners...');
    
    // Portfolio button click handler
    const portfolioBtn = document.getElementById('portfolioBtn');
    if (portfolioBtn) {
        portfolioBtn.addEventListener('click', function() {
            console.log('Portfolio button clicked, currentUser:', currentUser);
            
            // Initialize tokens when portfolio is opened
            if (typeof portfolioManager !== 'undefined') {
                portfolioManager.initializeAvailableTokens();
                portfolioManager.populateTokenDropdown();
                
                // Load portfolio if user is logged in
                if (currentUser) {
                    console.log('Loading portfolio for user:', currentUser);
                    portfolioManager.loadPortfolioFromServer();
                }
            }
        });
    } else {
        console.error('Portfolio button not found');
    }

    // Add token functionality
    const addTokenBtn = document.getElementById('addTokenBtn');
    if (addTokenBtn) {
        addTokenBtn.addEventListener('click', function() {
            console.log('Add token button clicked, currentUser:', currentUser);
            addTokenToPortfolio();
        });
        console.log('Add token button listener added');
    } else {
        console.error('Add token button not found');
    }

    // Clear portfolio functionality
    const clearPortfolioBtn = document.getElementById('clearPortfolioBtn');
    if (clearPortfolioBtn) {
        clearPortfolioBtn.addEventListener('click', () => {
            if (typeof portfolioManager !== 'undefined') {
                portfolioManager.clearPortfolio();
            }
        });
    }

    // Export portfolio functionality
    const exportPortfolioBtn = document.getElementById('exportPortfolioBtn');
    if (exportPortfolioBtn) {
        exportPortfolioBtn.addEventListener('click', () => {
            if (typeof portfolioManager !== 'undefined') {
                portfolioManager.exportPortfolio();
            }
        });
    }
}

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
        portfolioManager.showMessage('Please login to add tokens to your portfolio', 'error');
        
        // Switch to login tab
        switchAuthTab('login');
        return;
    }

    if (!selectedToken) {
        portfolioManager.showMessage('Please select a token', 'error');
        return;
    }

    if (!amount || parseFloat(amount) <= 0) {
        portfolioManager.showMessage('Please enter a valid amount', 'error');
        return;
    }

    if (typeof portfolioManager !== 'undefined') {
        console.log('Calling portfolioManager.addHolding...');
        portfolioManager.addHolding(selectedToken, amount, price);
    } else {
        console.error('Portfolio manager not available');
        portfolioManager.showMessage('Portfolio system not available. Please refresh the page.', 'error');
    }
}

// Trade button functionality
function setupTradeButton() {
    const tradeBtn = document.getElementById('tradeBtn');
    if (tradeBtn) {
        console.log('Setting up trade button functionality');
        tradeBtn.addEventListener('click', function() {
            console.log('Trade button clicked from script.js');
            // The modal opening is handled in the inline script in index.php
        });
    }
}

// ---------- Init ----------
function init() {
    console.log('Initializing application...');
    monitorConnection();
    setupDatabaseStatus();
    setupPortfolioEventListeners();
    setupTradeButton();
    
    // Setup event listeners
    const search = document.getElementById('searchInput');
    const sort = document.getElementById('sortSelect');
    const filter = document.getElementById('filterSelect');
    const refreshBtn = document.getElementById('refreshBtn');
    
    const highriskSearch = document.getElementById('highriskSearchInput');
    const highriskSort = document.getElementById('highriskSortSelect');
    const highriskFilter = document.getElementById('highriskFilterSelect');
    
    if (search) search.addEventListener('input', () => renderTable(newListings, 'new-tokens', true));
    if (sort) sort.addEventListener('change', () => renderTable(newListings, 'new-tokens', true));
    if (filter) filter.addEventListener('change', () => renderTable(newListings, 'new-tokens', true));
    
    if (highriskSearch) highriskSearch.addEventListener('input', () => renderTable(highRiskListings, 'highrisk-tokens', true, true));
    if (highriskSort) highriskSort.addEventListener('change', () => renderTable(highRiskListings, 'highrisk-tokens', true, true));
    if (highriskFilter) highriskFilter.addEventListener('change', () => renderTable(highRiskListings, 'highrisk-tokens', true, true));
    
    if (refreshBtn) refreshBtn.addEventListener('click', refreshAll);
    
    document.querySelectorAll('th[data-sort]').forEach(th => {
        th.addEventListener('click', () => {
            const sortBy = th.getAttribute('data-sort');
            const tableSection = th.closest('.section');
            
            if (tableSection.querySelector('#highrisk-tokens')) {
                document.getElementById('highriskSortSelect').value = sortBy;
                renderTable(highRiskListings, 'highrisk-tokens', true, true);
            } else if (tableSection.querySelector('#new-tokens')) {
                document.getElementById('sortSelect').value = sortBy;
                renderTable(newListings, 'new-tokens', true);
            } else if (tableSection.querySelector('#popular-tokens')) {
                popularListings.sort((a, b) => {
                    if (sortBy === 'price') return (b.price || 0) - (a.price || 0);
                    if (sortBy === 'volume') return b.volume - a.volume;
                    if (sortBy === 'change') return b.change - a.change;
                    if (sortBy === 'liquidity') return (b.liquidityUsd || 0) - (a.liquidityUsd || 0);
                    if (sortBy === 'marketCap') return (b.marketCap || 0) - (a.marketCap || 0);
                    if (sortBy === 'name') return a.name.localeCompare(b.name);
                    if (sortBy === 'symbol') return a.symbol.localeCompare(b.symbol);
                    return 0;
                });
                renderTable(popularListings, 'popular-tokens', false);
            }
        });
    });
    
    refreshAll();
    setupAutoRefresh();
    
    // Initialize portfolio manager if user is logged in
    if (currentUser && typeof portfolioManager !== 'undefined') {
        console.log('User is logged in, pre-loading portfolio');
        setTimeout(() => {
            portfolioManager.initializeAvailableTokens();
            portfolioManager.populateTokenDropdown();
            portfolioManager.loadPortfolioFromServer();
        }, 2000);
    }
}

// Start the application
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM Content Loaded - starting init');
    init();
});

// Enhanced portfolio initialization
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM loaded, initializing portfolio...');
    
    // Initialize portfolio when modal opens
    const portfolioBtn = document.getElementById('portfolioBtn');
    const portfolioModal = document.getElementById('portfolioModal');
    
    if (portfolioBtn && portfolioModal) {
        portfolioBtn.addEventListener('click', function() {
            console.log('Portfolio button clicked, user:', currentUser);
            
            // Small delay to ensure modal is visible
            setTimeout(() => {
                if (typeof portfolioManager !== 'undefined') {
                    console.log('Initializing portfolio manager...');
                    portfolioManager.initializeAvailableTokens();
                    portfolioManager.populateTokenDropdown();
                    
                    if (currentUser) {
                        console.log('Loading portfolio for logged in user');
                        portfolioManager.loadPortfolioFromServer();
                    } else {
                        console.log('No user logged in, showing auth form');
                    }
                } else {
                    console.error('Portfolio manager not defined');
                }
            }, 100);
        });
    }
    
    // Also initialize when page loads if user is logged in
    if (currentUser && typeof portfolioManager !== 'undefined') {
        console.log('User is logged in, pre-loading portfolio');
        setTimeout(() => {
            portfolioManager.initializeAvailableTokens();
            portfolioManager.populateTokenDropdown();
            portfolioManager.loadPortfolioFromServer();
        }, 2000);
    }
});

// Debug function to check portfolio state
function debugPortfolio() {
    console.log('Current user:', currentUser);
    console.log('Portfolio holdings:', portfolioManager.holdings);
    console.log('Available tokens count:', portfolioManager.availableTokens.size);
    
    // Open debug page
    window.open('./debug_portfolio.php', '_blank');
}

// Expose for inline handler
window.openChart = openChart;
window.portfolioManager = portfolioManager;
window.authManager = authManager;
window.switchAuthTab = switchAuthTab;
window.debugPortfolio = debugPortfolio;
window.addTokenToPortfolio = addTokenToPortfolio;