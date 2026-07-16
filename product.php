<?php

require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/cart.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 1;

$product = getProductById($pdo, $id);

if (!$product) {
    $product = getProductById($pdo, 1);
    $id = 1;
}

$addedToCart = false;
$cartMessage = '';

if (isset($_POST['add_to_cart'])) {

    requireLogin('/emPIEsema/product.php?id=' . $id);

    $result = addToCart($pdo, (int)$_SESSION['account_id'], $id, 1);

    if ($result === 'out_of_stock') {
        $cartMessage = 'Sorry, this item is out of stock.';
    } elseif ($result === 'capped') {
        $cartMessage = 'You already have the maximum available stock of this item in your cart.';
    } else {
        $addedToCart = true;
        $cartMessage = 'Added to your cart.';
    }

}

$inStock = (int)($product['stock'] ?? 0) > 0;

$brandCredits = [
    'travel'   => ['name' => 'Globe-Trotter', 'url' => 'https://www.globe-trotter.com/'],
    'men'      => ['name' => 'Louis Vuitton', 'url' => 'https://ph.louisvuitton.com/eng-ph/homepage'],
    'women'    => ['name' => 'Louis Vuitton', 'url' => 'https://ph.louisvuitton.com/eng-ph/homepage'],
    'backpack' => ['name' => 'Prada', 'url' => 'https://www.prada.com/us/en.html'],
];
$brandCredit = $brandCredits[$product['category'] ?? ''] ?? $brandCredits['men'];

?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo htmlspecialchars($product['name']); ?> | emPIEsema</title>

    <link rel="stylesheet" href="style.css?v=17">

    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

</head>

<body>

<?php include __DIR__ . '/includes/header.php'; ?>

<!-- PRODUCT -->

<section class="product-page">

    <div class="product-image">

        <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">

    </div>

    <div class="product-details">

    <div class="product-header">

        <div>

            <?php if (!empty($product['code'])): ?>
                <span class="product-code"><?php echo htmlspecialchars($product['code']); ?></span>
            <?php endif; ?>

                <h1><?php echo htmlspecialchars($product['name']); ?></h1>

                <h2>₱<?php echo number_format((float)$product['price'], 2); ?></h2>

                <?php if ($inStock): ?>
                    <span class="stock-badge stock-in"><i class="fa-solid fa-check"></i> In Stock (<?php echo (int)$product['stock']; ?> left)</span>
                <?php else: ?>
                    <span class="stock-badge stock-out"><i class="fa-solid fa-xmark"></i> Out of Stock</span>
                <?php endif; ?>

            </div>

            <form method="POST">

                <button type="submit" name="add_to_cart" class="add-to-cart-btn <?php echo $addedToCart ? 'is-filled' : ''; ?>" title="Add to Cart" <?php echo $inStock ? '' : 'disabled'; ?>>

                    <i class="fa-solid fa-cart-shopping"></i>

                </button>

            </form>

        </div>

        <?php if ($cartMessage !== ''): ?>
        <p class="cart-flash <?php echo $addedToCart ? '' : 'cart-flash-warn'; ?>"><?php echo htmlspecialchars($cartMessage); ?></p>
        <?php endif; ?>

    <p class="description">
        <?php echo nl2br(htmlspecialchars($product['description'])); ?>
    </p>

        <?php if (!empty($product['dimensions'])): ?>
        <div class="dimensions">
            <strong><?php echo htmlspecialchars($product['dimensions']); ?></strong><br>
            (Length × Height × Width)
        </div>
        <?php endif; ?>

        <?php if (!empty($product['left_specs']) || !empty($product['right_specs'])): ?>
        <div class="specifications">

            <ul>
                <?php foreach ($product['left_specs'] as $spec): ?>
                <li><?php echo htmlspecialchars($spec); ?></li>
                <?php endforeach; ?>
            </ul>

            <ul>
                <?php foreach ($product['right_specs'] as $spec): ?>
                <li><?php echo htmlspecialchars($spec); ?></li>
                <?php endforeach; ?>
            </ul>

        </div>
        <?php endif; ?>

        <?php if (!empty($product['made'])): ?>
        <p class="made">
            <?php echo htmlspecialchars($product['made']); ?>
        </p>
        <?php endif; ?>

        <a href="shop.php" class="btn">Back to Shop</a>

    </div>

</section>

<div class="product-credit">
    Product courtesy of <a href="<?php echo htmlspecialchars($brandCredit['url']); ?>" target="_blank" rel="noopener noreferrer"><?php echo htmlspecialchars($brandCredit['name']); ?></a>. All product names, images, and trademarks belong to their respective owners.
</div>

<?php include __DIR__ . '/includes/site-footer.php'; ?>

</body>
</html>
