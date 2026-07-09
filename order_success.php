<?php
require_once __DIR__ . '/includes/orders.php';

requireLogin('/emPIEsema/index.php');

$orderId = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$order = getOrderById($pdo, $orderId, (int)$_SESSION['account_id']);

if (!$order) {
    header('Location: /emPIEsema/index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmed | emPIEsema</title>

    <link rel="stylesheet" href="style.css?v=8">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body>

<?php include __DIR__ . '/includes/header.php'; ?>

<section class="order-success-page">

    <div class="order-success-card">

        <i class="fa-solid fa-circle-check order-success-icon"></i>

        <h1>Order Placed!</h1>
        <p>Thank you, <?php echo htmlspecialchars($order['full_name']); ?>. Your order <strong>#<?php echo (int)$order['id']; ?></strong> has been received and will be paid via <strong>Cash on Delivery</strong>.</p>

        <div class="order-success-details">

            <h3>Delivering To</h3>
            <p><?php echo htmlspecialchars($order['full_name']); ?> · <?php echo htmlspecialchars($order['phone']); ?></p>
            <p><?php echo htmlspecialchars($order['address']); ?>, <?php echo htmlspecialchars($order['city']); ?></p>
            <?php if (!empty($order['notes'])): ?>
                <p class="order-success-notes">Note: <?php echo htmlspecialchars($order['notes']); ?></p>
            <?php endif; ?>

            <h3>Items</h3>
            <?php foreach ($order['items'] as $item): ?>
                <div class="order-success-item">
                    <span><?php echo htmlspecialchars($item['product_name']); ?> × <?php echo (int)$item['quantity']; ?></span>
                    <span>₱<?php echo number_format((float)$item['price'] * $item['quantity'], 2); ?></span>
                </div>
            <?php endforeach; ?>

            <div class="order-success-item order-success-total">
                <span>Total (Cash on Delivery)</span>
                <span>₱<?php echo number_format((float)$order['total'], 2); ?></span>
            </div>

        </div>

        <a href="/emPIEsema/shop.php" class="btn">Continue Shopping</a>

    </div>

</section>

</body>
</html>
