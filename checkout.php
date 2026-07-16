<?php
require_once __DIR__ . '/includes/orders.php';

requireLogin('/emPIEsema/checkout.php');

$accountId = (int)$_SESSION['account_id'];
$items = getCartItems($pdo, $accountId);
$errors = [];

$form = [
    'full_name' => '',
    'phone' => '',
    'address' => '',
    'city' => '',
    'notes' => '',
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    foreach ($form as $key => $default) {
        $form[$key] = trim($_POST[$key] ?? '');
    }

    if (empty($items)) {
        $errors[] = 'Your cart is empty.';
    }
    if ($form['full_name'] === '') {
        $errors[] = 'Full name is required.';
    }
    if ($form['phone'] === '') {
        $errors[] = 'Phone number is required.';
    }
    if ($form['address'] === '') {
        $errors[] = 'Delivery address is required.';
    }
    if ($form['city'] === '') {
        $errors[] = 'City is required.';
    }

    if (empty($errors)) {
        $orderId = createOrder($pdo, $accountId, $form);

        if ($orderId) {
            header('Location: /emPIEsema/order_success.php?id=' . $orderId);
            exit;
        }

        $errors[] = 'Sorry, one or more items in your cart are no longer available in the quantity requested. Please review your cart and try again.';
        $items = getCartItems($pdo, $accountId);
    }
}

$subtotal = 0;
foreach ($items as $item) {
    $subtotal += $item['price'] * $item['quantity'];
}
$shippingFee = 0;
$total = $subtotal + $shippingFee;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout | emPIEsema</title>

    <link rel="stylesheet" href="style.css?v=17">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body>

<?php include __DIR__ . '/includes/header.php'; ?>

<?php if (empty($items) && empty($errors)): ?>

    <section class="cart-page">
        <h1>Checkout</h1>
        <p class="cart-empty">Your cart is empty. <a href="/emPIEsema/shop.php">Continue shopping →</a></p>
    </section>

<?php else: ?>

<section class="checkout-page">

    <div class="checkout-cart">

        <h1>Shopping Cart</h1>

        <?php if (!empty($errors)): ?>
            <div class="error"><?php echo implode('<br>', array_map('htmlspecialchars', $errors)); ?></div>
        <?php endif; ?>

        <table class="checkout-table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($items as $item): ?>
                <tr>
                    <td>
                        <div class="checkout-product">
                            <img src="/emPIEsema/<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>">
                            <div>
                                <strong><?php echo htmlspecialchars($item['name']); ?></strong>
                                <span>₱<?php echo number_format((float)$item['price'], 2); ?> each</span>
                            </div>
                        </div>
                    </td>
                    <td class="checkout-qty">× <?php echo (int)$item['quantity']; ?></td>
                    <td class="checkout-line-total">₱<?php echo number_format((float)$item['price'] * $item['quantity'], 2); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="checkout-summary">
            <div class="checkout-summary-row">
                <span>Subtotal</span>
                <span>₱<?php echo number_format($subtotal, 2); ?></span>
            </div>
            <div class="checkout-summary-row">
                <span>Shipping</span>
                <span>Free</span>
            </div>
            <div class="checkout-summary-row checkout-summary-total">
                <span>Total</span>
                <span>₱<?php echo number_format($total, 2); ?></span>
            </div>
        </div>

        <a href="/emPIEsema/cart.php" class="checkout-back"><i class="fa-solid fa-arrow-left"></i> Continue Shopping</a>

    </div>

    <div class="checkout-payment">

        <h1>Payment Info</h1>

        <form method="POST">

            <div class="field">
                <label>Payment Method</label>
                <div class="payment-method-locked">
                    <i class="fa-solid fa-money-bill-wave"></i>
                    <div>
                        <strong>Cash on Delivery</strong>
                        <span>Pay with cash when your order arrives</span>
                    </div>
                    <i class="fa-solid fa-circle-check payment-method-check"></i>
                </div>
            </div>

            <div class="form-section-label">Delivery Details</div>

            <div class="field">
                <label>Full Name</label>
                <input type="text" name="full_name" placeholder="Name on delivery" value="<?php echo htmlspecialchars($form['full_name']); ?>" required>
            </div>

            <div class="field">
                <label>Phone Number</label>
                <input type="text" name="phone" placeholder="09XXXXXXXXX" value="<?php echo htmlspecialchars($form['phone']); ?>" required>
            </div>

            <div class="field">
                <label>Delivery Address</label>
                <textarea name="address" rows="3" placeholder="House/Unit No., Street, Barangay" required><?php echo htmlspecialchars($form['address']); ?></textarea>
            </div>

            <div class="field">
                <label>City</label>
                <input type="text" name="city" placeholder="City / Municipality" value="<?php echo htmlspecialchars($form['city']); ?>" required>
            </div>

            <div class="field">
                <label>Notes (optional)</label>
                <textarea name="notes" rows="2" placeholder="Delivery instructions, landmark, etc."><?php echo htmlspecialchars($form['notes']); ?></textarea>
            </div>

            <button type="submit" class="checkout-submit">Check Out — Cash on Delivery</button>

        </form>

    </div>

</section>

<?php endif; ?>

<?php include __DIR__ . '/includes/site-footer.php'; ?>

</body>
</html>
