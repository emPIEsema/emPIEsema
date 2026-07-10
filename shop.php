<?php
require_once __DIR__ . '/includes/functions.php';

$category = isset($_GET['category']) ? $_GET['category'] : 'travel';

$travelProducts = getProductsByCategory($pdo, 'travel');
$menProducts = getProductsByCategory($pdo, 'men');
$womenProducts = getProductsByCategory($pdo, 'women');
$backpackProducts = getProductsByCategory($pdo, 'backpack');

function renderProductCards(array $products): void
{
    foreach ($products as $p) {
        echo '<div class="card">';
        echo '<a href="product.php?id=' . (int)$p['id'] . '" class="product-link">';
        echo '<img src="' . htmlspecialchars($p['image']) . '" alt="' . htmlspecialchars($p['name']) . '">';
        echo '</a>';
        echo '<h3>' . htmlspecialchars($p['name']) . '</h3>';
        echo '<p>₱' . number_format((float)$p['price'], 2) . '</p>';
        echo '</div>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop | emPIEsema</title>

    <link rel="stylesheet" href="style.css?v=12">

    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@500;600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

</head>

<body>

<?php include __DIR__ . '/includes/header.php'; ?>

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

        </ul>

    </aside>

    <!-- Main Content -->

    <main class="shop-content">

        <!-- ================= TRAVEL BAGS ================= -->

        <section id="travel" class="category-section">

            <div class="category-header">
                <h2>Travel Bags</h2>
            </div>

            <div class="horizontal-products">
                <?php renderProductCards($travelProducts); ?>
            </div>

        </section>

        <!-- ================= MEN'S BAGS ================= -->

        <section id="men" class="category-section">

            <div class="category-header">
                <h2>Men's Bags</h2>
            </div>

            <div class="horizontal-products">
                <?php renderProductCards($menProducts); ?>
            </div>

        </section>

        <!-- ================= WOMEN'S BAGS ================= -->

        <section id="women" class="category-section">

            <div class="category-header">
                <h2>Women's Bags</h2>
            </div>

            <div class="horizontal-products">
                <?php renderProductCards($womenProducts); ?>
            </div>

        </section>

        <!-- ================= BACKPACKS ================= -->

        <section id="backpack" class="category-section">

            <div class="category-header">
                <h2>Backpacks</h2>
            </div>

            <div class="horizontal-products">
                <?php renderProductCards($backpackProducts); ?>
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
