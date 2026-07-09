<?php
require_once __DIR__ . '/cart.php';

$cartCount = isLoggedIn() ? getCartCount($pdo, (int)$_SESSION['account_id']) : 0;
$cartHref = isLoggedIn() ? '/emPIEsema/cart.php' : '/emPIEsema/login.php?redirect=' . urlencode('/emPIEsema/cart.php');
?>
<header>

    <div class="logo">
        <a href="/emPIEsema/index.php">
            <img src="/emPIEsema/images/logo.png" alt="emPIEsema">
        </a>
    </div>

    <nav>
        <ul>
            <li><a href="/emPIEsema/shop.php">Shop</a></li>
            <li><a href="/emPIEsema/collections.php">Collections</a></li>
            <li><a href="/emPIEsema/about.php">About Us</a></li>
            <li><a href="#" id="contactBtn">Contact</a></li>
        </ul>
    </nav>

    <div class="nav-icons">

        <?php if (isAdmin()): ?>
            <a href="/emPIEsema/admin/index.php" title="Admin Panel">
                <i class="fa-solid fa-gauge"></i>
            </a>
        <?php endif; ?>

        <?php if (isLoggedIn()): ?>
            <a href="/emPIEsema/logout.php" class="user-avatar" title="Logout (<?php echo htmlspecialchars(currentUsername()); ?>)">
                <span class="user-avatar-initial"><?php echo htmlspecialchars(strtoupper(substr(currentUsername(), 0, 1))); ?></span>
                <span class="user-avatar-logout"><i class="fa-solid fa-arrow-right-from-bracket"></i></span>
            </a>
        <?php else: ?>
            <a href="/emPIEsema/login.php" title="Login">
                <i class="fa-solid fa-user"></i>
            </a>
        <?php endif; ?>

        <a href="<?php echo $cartHref; ?>" title="Cart">
            <i class="fa-regular fa-heart"></i>
        </a>

        <a href="<?php echo $cartHref; ?>" title="Cart" class="cart-icon">
            <i class="fa-solid fa-cart-shopping"></i>
            <?php if ($cartCount > 0): ?>
                <span class="cart-badge"><?php echo $cartCount; ?></span>
            <?php endif; ?>
        </a>

        <a href="#" id="searchToggleBtn" title="Search">
            <i class="fa-solid fa-magnifying-glass"></i>
        </a>

    </div>

</header>

<!-- SEARCH OVERLAY -->

<div id="searchOverlay" class="search-overlay">
    <div class="search-panel">

        <button type="button" id="searchCloseBtn" class="search-close" title="Close">&times;</button>

        <span class="search-panel-eyebrow">emPIEsema</span>
        <h2>What are you looking for?</h2>

        <form action="/emPIEsema/search.php" method="GET" class="search-box">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="text" name="q" id="searchInput" placeholder="Search bags, luggage, backpacks..." autocomplete="off" value="<?php echo htmlspecialchars($_GET['q'] ?? ''); ?>">
            <button type="submit" title="Search"><i class="fa-solid fa-arrow-right"></i></button>
        </form>

        <div class="search-suggestions">
            <a href="/emPIEsema/shop.php#travel">Travel Bags</a>
            <a href="/emPIEsema/shop.php#men">Men's Bags</a>
            <a href="/emPIEsema/shop.php#women">Women's Bags</a>
            <a href="/emPIEsema/shop.php#backpack">Backpacks</a>
            <a href="/emPIEsema/collections.php">All Collections</a>
        </div>

    </div>
</div>

<script>
(function () {
    const overlay = document.getElementById('searchOverlay');
    const toggleBtn = document.getElementById('searchToggleBtn');
    const closeBtn = document.getElementById('searchCloseBtn');
    const input = document.getElementById('searchInput');

    toggleBtn.addEventListener('click', function (e) {
        e.preventDefault();
        overlay.classList.add('active');
        setTimeout(function () { input.focus(); }, 50);
    });

    closeBtn.addEventListener('click', function () {
        overlay.classList.remove('active');
    });

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            overlay.classList.remove('active');
        }
    });
})();
</script>
