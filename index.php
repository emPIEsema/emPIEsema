<?php
require_once __DIR__ . '/includes/functions.php';
$featuredProducts = getFeaturedProducts($pdo);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>emPIEsema | Every Journey. Every Bag. Every You.</title>

    <link rel="stylesheet" href="style.css?v=16">

    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body>

<?php include __DIR__ . '/includes/header.php'; ?>

<!-- ================= HERO ================= -->

<section class="hero">

    <div class="hero-image">

        <img src="images/hero.avif" alt="Travel Bags">

    </div>

    <div class="hero-content">

        <h1>Premium Bags for Every Journey</h1>

        <p>

            Discover stylish luggage, travel bags, backpacks and
            everyday carry essentials designed to accompany you
            wherever life takes you.

        </p>

        <a href="shop.php" class="btn">
            Shop Now
        </a>

    </div>

</section>

<!-- ================= FEATURES ================= -->

<section class="about-store">

    <h1>Welcome to emPIEsema</h1>

    <p>
        <strong>Every Journey. Every Bag. Every You.</strong>
    </p>

    <p>
        emPIEsema is your trusted destination for premium-quality bags designed
        for every lifestyle. Whether you're traveling, heading to work, going
        to school, or simply looking for an everyday companion, we have the
        perfect bag for you.
    </p>

    <p>
        Our collection includes travel bags, men's bags, women's bags,
        backpacks, and wallet bags that combine style, durability, and
        functionality. Every product is carefully selected to provide comfort,
        quality, and value for every customer.
    </p>

    <div class="about-features">

        <div class="feature-box">
            <i class="fa-solid fa-suitcase"></i>
            <h3>Premium Quality</h3>
            <p>Built with durable materials for everyday use and travel.</p>
        </div>

        <div class="feature-box">
            <i class="fa-solid fa-truck-fast"></i>
            <h3>Fast Delivery</h3>
            <p>Reliable nationwide shipping to your doorstep.</p>
        </div>

        <div class="feature-box">
            <i class="fa-solid fa-shield-halved"></i>
            <h3>Secure Shopping</h3>
            <p>Safe checkout and trusted customer service.</p>
        </div>

    </div>

</section>

<!-- ================= PRODUCTS ================= -->

<section class="products">

    <aside class="sidebar">

        <h2>Categories</h2>

        <ul class="category-list">

            <li><a href="shop.php#travel">Travel Bags</a></li>

            <li><a href="shop.php#men">Men's Bags</a></li>

            <li><a href="shop.php#women">Women's Bags</a></li>

            <li><a href="shop.php#backpack">Backpacks</a></li>

        </ul>

    </aside>

    <div class="product-area">

        <div class="section-title">

            <h2>Featured Collection</h2>

        </div>

        <div class="product-grid">

            <?php foreach ($featuredProducts as $p): ?>

            <div class="card">

                <a href="product.php?id=<?php echo (int)$p['id']; ?>" class="product-link">
                    <img src="<?php echo htmlspecialchars($p['image']); ?>" alt="<?php echo htmlspecialchars($p['name']); ?>">
                </a>

                <h3><?php echo htmlspecialchars($p['name']); ?></h3>

                <p>₱<?php echo number_format((float)$p['price'], 2); ?></p>

            </div>

            <?php endforeach; ?>

        </div>

    </div>

</section>

<!-- ================= WHY US ================= -->

<section class="why">

    <h2>Why Choose emPIEsema?</h2>

    <div class="why-grid">

        <div class="why-box">

            <i class="fa-solid fa-medal"></i>

            <h3>Premium Quality</h3>

        </div>

        <div class="why-box">

            <i class="fa-solid fa-plane"></i>

            <h3>Travel Friendly</h3>

        </div>

        <div class="why-box">

            <i class="fa-solid fa-truck-fast"></i>

            <h3>Fast Delivery</h3>

        </div>

        <div class="why-box">

            <i class="fa-solid fa-shield"></i>

            <h3>Secure Payment</h3>

        </div>

    </div>

</section>

<!-- ================= FOOTER ================= -->

<footer>

    <div class="footer-logo">

        <img src="images/logo.png" alt="">

        <p>Every Journey. Every Bag. Every You.</p>

    </div>

    <div class="footer-links">

        <h3>Categories</h3>

        <a href="shop.php#travel">Travel Bags</a>
        
        <a href="shop.php#men">Men's Bags</a>

        <a href="shop.php#women">Women's Bags</a>

        <a href="shop.php#backpack">Backpacks</a>

    </div>

</footer>

<div class="copyright">

    © 2026 emPIEsema. All Rights Reserved.

    <p class="disclaimer">Disclaimer: This website was created for educational purposes only and is a requirement for our final project.</p>

</div>

<!-- CONTACT POPUP -->

<div id="contactModal" class="modal">

    <div class="modal-content">

        <span class="close">&times;</span>

        <h2>Contact emPIEsema</h2>

        <p>
            <i class="fa-solid fa-envelope"></i>
            <strong>Email:</strong><br>
            emPIEsema@gmail.com
        </p>

        <p>
            <i class="fa-solid fa-phone"></i>
            <strong>Phone:</strong><br>
            09204050463
        </p>

    </div>

</div>

<script>

const modal = document.getElementById("contactModal");

const btn = document.getElementById("contactBtn");

const closeBtn = document.querySelector(".close");

btn.onclick = function(e){

    e.preventDefault();

    modal.style.display = "flex";

}

closeBtn.onclick = function(){

    modal.style.display = "none";

}

window.onclick = function(e){

    if(e.target == modal){

        modal.style.display = "none";

    }

}

</script>

</body>
</html>