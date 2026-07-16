<?php
require_once __DIR__ . '/includes/cart.php';

requireLogin('/emPIEsema/cart.php');

$accountId = (int)$_SESSION['account_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $productId = (int)($_POST['product_id'] ?? 0);

    if (isset($_POST['remove'])) {
        removeFromCart($pdo, $accountId, $productId);
    } elseif (isset($_POST['update'])) {
        updateCartQty($pdo, $accountId, $productId, (int)($_POST['quantity'] ?? 1));
    }

    header('Location: /emPIEsema/cart.php');
    exit;
}

$items = getCartItems($pdo, $accountId);

$total = 0;
foreach ($items as $item) {
    $total += $item['price'] * $item['quantity'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart | emPIEsema</title>

    <link rel="stylesheet" href="style.css?v=16">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body>

<?php include __DIR__ . '/includes/header.php'; ?>

<section class="cart-page">

    <h1>Your Cart</h1>

    <?php if (empty($items)): ?>

        <p class="cart-empty">Your cart is empty. <a href="/emPIEsema/shop.php">Continue shopping →</a></p>

    <?php else: ?>

        <div class="cart-list">

            <?php foreach ($items as $item): ?>
            <div class="cart-row">

                <img src="/emPIEsema/<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>">

                <div class="cart-info">
                    <h3><?php echo htmlspecialchars($item['name']); ?></h3>
                    <p>₱<?php echo number_format((float)$item['price'], 2); ?></p>
                    <p class="cart-stock-note"><?php echo (int)$item['stock']; ?> in stock</p>
                </div>

                <form method="POST" class="cart-qty-form">
                    <input type="hidden" name="product_id" value="<?php echo (int)$item['product_id']; ?>">
                    <input type="number" name="quantity" value="<?php echo (int)$item['quantity']; ?>" min="1" max="<?php echo (int)$item['stock']; ?>">
                    <button type="submit" name="update" class="cart-update"><i class="fa-solid fa-rotate"></i> Update</button>
                </form>

                <p class="cart-subtotal">₱<?php echo number_format((float)$item['price'] * $item['quantity'], 2); ?></p>

                <form method="POST">
                    <input type="hidden" name="product_id" value="<?php echo (int)$item['product_id']; ?>">
                    <button type="submit" name="remove" class="cart-remove"><i class="fa-solid fa-trash-can"></i> Remove</button>
                </form>

            </div>
            <?php endforeach; ?>

        </div>

        <div class="cart-total">
            <span>Total</span>
            <strong>₱<?php echo number_format($total, 2); ?></strong>
        </div>

        <div class="cart-actions">
            <a href="/emPIEsema/shop.php" class="btn btn-outline">Continue Shopping</a>
            <a href="/emPIEsema/checkout.php" class="btn">Proceed to Checkout</a>
        </div>

    <?php endif; ?>

</section>

</body>
</html>
