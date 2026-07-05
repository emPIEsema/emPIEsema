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

            <li class="active" data-target="travel">
                <a href="#travel">
                    <i class="fa-solid fa-suitcase"></i>
                    <span>Travel Bags</span>
                </a>
            </li>

            <li data-target="men">
                <a href="#men">
                    <i class="fa-solid fa-briefcase"></i>
                    <span>Men's Bags</span>
                </a>
            </li>

            <li data-target="women">
                <a href="#women">
                    <i class="fa-solid fa-bag-shopping"></i>
                    <span>Women's Bags</span>
                </a>
            </li>

            <li data-target="backpack">
                <a href="#backpack">
                    <i class="fa-solid fa-suitcase"></i>
                    <span>Backpacks</span>
                </a>
            </li>

            <li data-target="wallet">
                <a href="#wallet">
                    <i class="fa-solid fa-wallet"></i>
                    <span>Wallet Bags</span>
                </a>
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

                    <img src="images/travel1.webp" alt="">

                    <h3>FPM Bank Centenary</h3>
                    <h3>55 Spinner</h3>

                    <p>₱125,555.00</p>

                    <button>View Product</button>

                </div>

                <!-- Product 2 -->

                <div class="card">

                    <img src="images/travel2.webp" alt="">

                    <h3>Safari</h3>
                    <h3>Carry-On - 4 Wheels</h3>

                    <p>₱132,555.00</p>

                    <button>View Product</button>

                </div>

                <!-- Product 3 -->

                <div class="card">

                    <img src="images/travel3.webp" alt="">

                    <h3>Centenary</h3>
                    <h3>Carry-On - 4 Wheels</h3>

                    <p>₱132,555.00</p>

                    <button>View Product</button>

                </div>

                <!-- Product 4 -->

                <div class="card">

                    <img src="images/travel4.webp" alt="">

                    <h3>Peanuts</h3>
                    <h3>Carry-On - 4 Wheels</h3>

                    <p>₱160,510.00</p>

                    <button>View Product</button>

                </div>

                <!-- Product 5 -->

                <div class="card">

                    <img src="images/travel5.webp" alt="">

                    <h3>Safari</h3>
                    <h3>XL Check-In - 4 Wheels</h3>

                    <p>₱209,470.00</p>

                    <button>View Product</button>

                </div>

                <!-- Product 6 -->

                <div class="card">

                    <img src="images/travel6.webp" alt="">

                    <h3>Centenary</h3>
                    <h3>Large Check-In - 4 Wheels</h3>

                    <p>₱174,500.00</p>

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
                    <img src="images/men1.avif" alt="">
                    <h3>Trio Messenger</h3>
                    <p>₱178,000.00</p>
                    <button>View Product</button>
                </div>

                <div class="card">
                    <img src="images/men2.avif" alt="">
                    <h3>Discovery Bumbag PM</h3>
                    <p>₱129,000.00</p>
                    <button>View Product</button>
                </div>

                <div class="card">
                    <img src="images/men3.avif" alt="">
                    <h3>Avenue Slingbag PM</h3>
                    <p>₱137,000.00</p>
                    <button>View Product</button>
                </div>

                <div class="card">
                    <img src="images/men4.avif" alt="">
                    <h3>Keepall Bandoulière 35</h3>
                    <p>₱168,000.00</p>
                    <button>View Product</button>
                </div>

                <div class="card">
                    <img src="images/men5.avif" alt="">
                    <h3>Courrier Messenger</h3>
                    <p>₱182,000.00</p>
                    <button>View Product</button>
                </div>

                <div class="card">
                    <img src="images/men6.avif" alt="">
                    <h3>District PM</h3>
                    <p>₱129,000.00</p>
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
                    <img src="images/women1.avif" alt="">
                    <h3>Speedy Bandoulière 20</h3>
                    <p>₱143,000.00</p>
                    <button>View Product</button>
                </div>

                <div class="card">
                    <img src="images/women2.avif" alt="">
                    <h3>Nano Madeleine</h3>
                    <p>₱175,000.00</p>
                    <button>View Product</button>
                </div>

                <div class="card">
                    <img src="images/women3.avif" alt="">
                    <h3>Wallet On Chain Ivy</h3>
                    <p>₱142,000.00</p>
                    <button>View Product</button>
                </div>

                <div class="card">
                    <img src="images/women4.avif" alt="">
                    <h3>Squire East West</h3>
                    <p>₱144,000.00  </p>
                    <button>View Product</button>
                </div>

                <div class="card">
                    <img src="images/women5.avif" alt="">
                    <h3>Vanity Chain Pouch</h3>
                    <p>₱190,000.00</p>
                    <button>View Product</button>
                </div>

                <div class="card">
                    <img src="images/women6.avif" alt="">
                    <h3>Trunkie East West</h3>
                    <p>₱191,000.00</p>
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

                    <img src="images/backpack1.avif" alt="Prada Explore Re-Nylon and leather backpack">

                    <h3>Prada Explore Re-Nylon and leather backpack</h3>

                    <p>₱215,300.50</p>

                    <button>View Product</button>

                </div>

                <!-- Product 2 -->

                <div class="card">

                    <img src="images/backpack2.avif" alt="Re-Nylon backpack">

                    <h3>Re-Nylon backpack</h3>

                    <p>₱190,700.00</p>

                    <button>View Product</button>

                </div>

                <!-- Product 3 -->

                <div class="card">

                    <img src="images/backpack3.avif" alt="Prada Explore leather backpack">

                    <h3>Prada Explore leather backpack</h3>

                    <p>₱369,100.00</p>

                    <button>View Product</button>

                </div>

                <!-- Product 4 -->

                <div class="card">

                    <img src="images/backpack4.avif" alt="Re-Nylon and Saffiano leather backpack">

                    <h3>Re-Nylon and Saffiano leather backpack</h3>

                    <p>₱175,300.00</p>

                    <button>View Product</button>

                </div>

                <!-- Product 5 -->

                <div class="card">

                    <img src="images/backpack5.avif" alt="Prada Speedrock Re-Nylon and leather backpack">

                    <h3>Prada Speedrock Re-Nylon and leather backpack</h3>

                    <p>₱200,100.00</p>

                    <button>View Product</button>

                </div>

                <!-- Product 6 -->

                <div class="card">

                    <img src="images/backpack6.avif" alt="Leather backpack">

                    <h3>Leather backpack</h3>

                    <p>₱319,900.00</p>

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

<script>
const sections = document.querySelectorAll(".category-section");
const menuItems = document.querySelectorAll(".shop-sidebar li");

function updateActiveCategory() {

    let currentSection = "";

    sections.forEach(section => {
        const rect = section.getBoundingClientRect();

        if (rect.top <= 180 && rect.bottom >= 180) {
            currentSection = section.id;
        }
    });

    menuItems.forEach(item => {
        item.classList.remove("active");
    });

    if(currentSection){
        document.querySelector(`.shop-sidebar li[data-target="${currentSection}"]`)?.classList.add("active");
    }

}

window.addEventListener("scroll", updateActiveCategory);
window.addEventListener("load", updateActiveCategory);
</script>
</body>
</html>