<?php
require_once __DIR__ . '/cart.php';

$cartCount = isLoggedIn() ? getCartCount($pdo, (int)$_SESSION['account_id']) : 0;
$cartHref = isLoggedIn() ? BASE_URL . '/cart.php' : BASE_URL . '/login.php?redirect=' . urlencode(BASE_URL . '/cart.php');
?>
<header>

    <div class="logo">
        <a href="<?php echo BASE_URL; ?>/index.php">
            <img src="<?php echo BASE_URL; ?>/images/logo.png" alt="emPIEsema">
        </a>
    </div>

    <nav>
        <ul>
            <li><a href="<?php echo BASE_URL; ?>/shop.php">Shop</a></li>
            <li><a href="<?php echo BASE_URL; ?>/collections.php">Collections</a></li>
            <li><a href="<?php echo BASE_URL; ?>/about.php">About Us</a></li>
            <li><a href="#" id="contactBtn">Contact</a></li>
        </ul>
    </nav>

    <div class="nav-icons">

        <?php if (isAdmin()): ?>
            <a href="<?php echo BASE_URL; ?>/admin/index.php" title="Admin Panel">
                <i class="fa-solid fa-gauge"></i>
            </a>
        <?php endif; ?>

        <?php if (isLoggedIn()): ?>
            <a href="<?php echo BASE_URL; ?>/logout.php" class="user-avatar" title="Logout (<?php echo htmlspecialchars(currentUsername()); ?>)">
                <span class="user-avatar-initial"><?php echo htmlspecialchars(strtoupper(substr(currentUsername(), 0, 1))); ?></span>
                <span class="user-avatar-logout"><i class="fa-solid fa-arrow-right-from-bracket"></i></span>
            </a>
        <?php else: ?>
            <a href="<?php echo BASE_URL; ?>/login.php" title="Login">
                <i class="fa-solid fa-user"></i>
            </a>
        <?php endif; ?>

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

        <form action="<?php echo BASE_URL; ?>/search.php" method="GET" class="search-box">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="text" name="q" id="searchInput" placeholder="Search bags, luggage, backpacks..." autocomplete="off" value="<?php echo htmlspecialchars($_GET['q'] ?? ''); ?>">
            <button type="submit" title="Search"><i class="fa-solid fa-arrow-right"></i></button>
        </form>

        <div class="search-suggestions">
            <a href="<?php echo BASE_URL; ?>/shop.php#travel">Travel Bags</a>
            <a href="<?php echo BASE_URL; ?>/shop.php#men">Men's Bags</a>
            <a href="<?php echo BASE_URL; ?>/shop.php#women">Women's Bags</a>
            <a href="<?php echo BASE_URL; ?>/shop.php#backpack">Backpacks</a>
            <a href="<?php echo BASE_URL; ?>/collections.php">All Collections</a>
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
