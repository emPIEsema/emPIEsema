<?php
$category = isset($_GET['category']) ? $_GET['category'] : 'travel';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop | emPIEsema</title>

    <link rel="stylesheet" href="style.css">

    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@500;600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

</head>
<body>

<!-- ================= NAVBAR ================= -->

<header>

    <div class="logo">
        <a href="index.php">
            <img src="images/logo.png" alt="emPIEsema">
        </a>
    </div>

    <nav>
        <ul>
            <li><a href="shop.php">Shop</a></li>
            <li><a href="#">Collections</a></li>
            <li><a href="#">About Us</a></li>
            <li><a href="#">Contact</a></li>
        </ul>
    </nav>

    <div class="nav-icons">
        <i class="fa-regular fa-user"></i>
        <i class="fa-regular fa-heart"></i>
        <i class="fa-solid fa-cart-shopping"></i>
        <i class="fa-solid fa-magnifying-glass"></i>
    </div>

</header>

<!-- ================= SHOP ================= -->

<div class="shop-container">

    <!-- Sidebar -->

    <aside class="shop-sidebar">

        <ul>

            <li class="<?= ($category == 'travel') ? 'active' : ''; ?>">
                <i class="fa-solid fa-suitcase"></i>
                <a href="shop.php?category=travel#travel">Travel Bags</a>
            </li>

            <li class="<?= ($category == 'men') ? 'active' : ''; ?>">
                <i class="fa-solid fa-briefcase"></i>
                <a href="shop.php?category=men#men">Men's Bags</a>
            </li>

            <li class="<?= ($category == 'women') ? 'active' : ''; ?>">
                <i class="fa-solid fa-bag-shopping"></i>
                <a href="shop.php?category=women#women">Women's Bags</a>
            </li>

            <li class="<?= ($category == 'backpack') ? 'active' : ''; ?>">
                <i class="fa-solid fa-backpack"></i>
                <a href="shop.php?category=backpack#backpack">Backpacks</a>
            </li>

            <li class="<?= ($category == 'wallet') ? 'active' : ''; ?>">
                <i class="fa-solid fa-wallet"></i>
                <a href="shop.php?category=wallet#wallet">Wallet Bags</a>
            </li>

        </ul>

    </aside>

    <!-- Main Content -->

    <main class="shop-content">

        <!-- ================= TRAVEL BAGS ================= -->

        <section id="travel" class="category-section">

            <div class="category-header">

                <h2>Travel Bags</h2>

                <a href="#">View All →</a>

            </div>

            <div class="horizontal-products">

                <!-- Product 1 -->

                <div class="card">

                    <img src="images/travel1.jpg" alt="">

                    <h3>Explorer Duffel</h3>

                    <p>₱2,999</p>

                    <button>View Product</button>

                </div>

                <!-- Product 2 -->

                <div class="card">

                    <img src="images/travel2.jpg" alt="">

                    <h3>Cabin Travel Bag</h3>

                    <p>₱3,299</p>

                    <button>View Product</button>

                </div>

                <!-- Product 3 -->

                <div class="card">

                    <img src="images/travel3.jpg" alt="">

                    <h3>Rolling Travel Bag</h3>

                    <p>₱4,499</p>

                    <button>View Product</button>

                </div>

                <!-- Product 4 -->

                <div class="card">

                    <img src="images/travel4.jpg" alt="">

                    <h3>Weekender Bag</h3>

                    <p>₱2,899</p>

                    <button>View Product</button>

                </div>

                <!-- Product 5 -->

                <div class="card">

                    <img src="images/travel5.jpg" alt="">

                    <h3>Adventure Duffel</h3>

                    <p>₱3,599</p>

                    <button>View Product</button>

                </div>

                <!-- Product 6 -->

                <div class="card">

                    <img src="images/travel6.jpg" alt="">

                    <h3>Travel Organizer</h3>

                    <p>₱1,299</p>

                    <button>View Product</button>

                </div>

            </div>

        </section>

        <!-- ================= MEN'S BAGS ================= -->

        <section id="men" class="category-section">

            <div class="category-header">

                <h2>Men's Bags</h2>

                <a href="#">View All →</a>

            </div>

            <div class="horizontal-products">

                <div class="card">
                    <img src="images/men1.jpg" alt="">
                    <h3>Executive Briefcase</h3>
                    <p>₱4,299</p>
                    <button>View Product</button>
                </div>

                <div class="card">
                    <img src="images/men2.jpg" alt="">
                    <h3>Leather Messenger</h3>
                    <p>₱3,799</p>
                    <button>View Product</button>
                </div>

                <div class="card">
                    <img src="images/men3.jpg" alt="">
                    <h3>Business Backpack</h3>
                    <p>₱3,499</p>
                    <button>View Product</button>
                </div>

                <div class="card">
                    <img src="images/men4.jpg" alt="">
                    <h3>Crossbody Bag</h3>
                    <p>₱2,199</p>
                    <button>View Product</button>
                </div>

                <div class="card">
                    <img src="images/men5.jpg" alt="">
                    <h3>Laptop Bag</h3>
                    <p>₱2,699</p>
                    <button>View Product</button>
                </div>

                <div class="card">
                    <img src="images/men6.jpg" alt="">
                    <h3>Canvas Messenger</h3>
                    <p>₱2,399</p>
                    <button>View Product</button>
                </div>

            </div>

        </section>

        <!-- ================= WOMEN'S BAGS ================= -->

        <section id="women" class="category-section">

            <div class="category-header">

                <h2>Women's Bags</h2>

                <a href="#">View All →</a>

            </div>

            <div class="horizontal-products">

                <div class="card">
                    <img src="images/women1.jpg" alt="">
                    <h3>Elegant Tote</h3>
                    <p>₱2,499</p>
                    <button>View Product</button>
                </div>

                <div class="card">
                    <img src="images/women2.jpg" alt="">
                    <h3>Classic Handbag</h3>
                    <p>₱2,899</p>
                    <button>View Product</button>
                </div>

                <div class="card">
                    <img src="images/women3.jpg" alt="">
                    <h3>Shoulder Bag</h3>
                    <p>₱2,299</p>
                    <button>View Product</button>
                </div>

                <div class="card">
                    <img src="images/women4.jpg" alt="">
                    <h3>Mini Crossbody</h3>
                    <p>₱1,999</p>
                    <button>View Product</button>
                </div>

                <div class="card">
                    <img src="images/women5.jpg" alt="">
                    <h3>Fashion Tote</h3>
                    <p>₱2,399</p>
                    <button>View Product</button>
                </div>

                <div class="card">
                    <img src="images/women6.jpg" alt="">
                    <h3>Satchel Bag</h3>
                    <p>₱2,699</p>
                    <button>View Product</button>
                </div>

            </div>

        </section>

        <!-- ================= BACKPACKS ================= -->

        <section id="backpack" class="category-section">

            <div class="category-header">

                <h2>Backpacks</h2>

                <a href="#">View All →</a>

            </div>

            <div class="horizontal-products">

                <!-- Product 1 -->

                <div class="card">

                    <img src="images/backpack1.jpg" alt="Urban Backpack">

                    <h3>Urban Backpack</h3>

                    <p>₱2,499</p>

                    <button>View Product</button>

                </div>

                <!-- Product 2 -->

                <div class="card">

                    <img src="images/backpack2.jpg" alt="Laptop Backpack">

                    <h3>Laptop Backpack</h3>

                    <p>₱2,999</p>

                    <button>View Product</button>

                </div>

                <!-- Product 3 -->

                <div class="card">

                    <img src="images/backpack3.jpg" alt="Travel Backpack">

                    <h3>Travel Backpack</h3>

                    <p>₱3,299</p>

                    <button>View Product</button>

                </div>

                <!-- Product 4 -->

                <div class="card">

                    <img src="images/backpack4.jpg" alt="School Backpack">

                    <h3>School Backpack</h3>

                    <p>₱1,899</p>

                    <button>View Product</button>

                </div>

                <!-- Product 5 -->

                <div class="card">

                    <img src="images/backpack5.jpg" alt="Hiking Backpack">

                    <h3>Hiking Backpack</h3>

                    <p>₱3,799</p>

                    <button>View Product</button>

                </div>

                <!-- Product 6 -->

                <div class="card">

                    <img src="images/backpack6.jpg" alt="Anti-Theft Backpack">

                    <h3>Anti-Theft Backpack</h3>

                    <p>₱2,799</p>

                    <button>View Product</button>

                </div>

            </div>

        </section>

        <!-- ================= WALLET BAGS ================= -->

        <section id="wallet" class="category-section">

            <div class="category-header">

                <h2>Wallet Bags</h2>

                <a href="#">View All →</a>

            </div>

            <div class="horizontal-products">

                <!-- Product 1 -->

                <div class="card">

                    <img src="images/wallet1.jpg" alt="Leather Wallet">

                    <h3>Leather Wallet</h3>

                    <p>₱1,299</p>

                    <button>View Product</button>

                </div>

                <!-- Product 2 -->

                <div class="card">

                    <img src="images/wallet2.jpg" alt="Zip Wallet">

                    <h3>Zip Wallet</h3>

                    <p>₱999</p>

                    <button>View Product</button>

                </div>

                <!-- Product 3 -->

                <div class="card">

                    <img src="images/wallet3.jpg" alt="Mini Wallet Bag">

                    <h3>Mini Wallet Bag</h3>

                    <p>₱1,499</p>

                    <button>View Product</button>

                </div>

                <!-- Product 4 -->

                <div class="card">

                    <img src="images/wallet4.jpg" alt="Card Holder">

                    <h3>Card Holder</h3>

                    <p>₱799</p>

                    <button>View Product</button>

                </div>

                <!-- Product 5 -->

                <div class="card">

                    <img src="images/wallet5.jpg" alt="Long Wallet">

                    <h3>Long Wallet</h3>

                    <p>₱1,699</p>

                    <button>View Product</button>

                </div>

                <!-- Product 6 -->

                <div class="card">

                    <img src="images/wallet6.jpg" alt="Travel Wallet">

                    <h3>Travel Wallet</h3>

                    <p>₱1,899</p>

                    <button>View Product</button>

                </div>

            </div>

        </section>

    </main>

</div>

</body>
</html>