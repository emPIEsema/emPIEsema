<?php
require_once __DIR__ . '/../includes/orders.php';

requireAdmin();

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['status'])) {
    updateOrderStatus($pdo, $id, $_POST['status']);
    header('Location: order_view.php?id=' . $id . '&saved=1');
    exit;
}

$order = getOrderById($pdo, $id);

if (!$order) {
    header('Location: orders.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order #<?php echo (int)$order['id']; ?> | emPIEsema Admin</title>

    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<<<<<<< HEAD
    <link rel="stylesheet" href="admin.css?v=6">
=======
    <link rel="stylesheet" href="admin.css?v=5">
>>>>>>> 0c6d304ba7fa2b3aabd4388a295d8bbe207c534a
</head>
<body>

<div class="admin-topbar">
    <div class="admin-brand">
        <span class="mark">emPIEsema</span>
        <span class="tag">Admin</span>
    </div>
    <div class="admin-user">
        <span>Logged in as <strong><?php echo htmlspecialchars(currentUsername()); ?></strong></span>
        <a href="../index.php" class="view-site" target="_blank">View Site</a>
        <a href="../logout.php" class="logout-link">Logout</a>
    </div>
</div>

<div class="admin-wrap">

    <div class="admin-header">
        <div>
            <h1>Order #<?php echo (int)$order['id']; ?></h1>
            <p class="sub">Placed <?php echo date('M j, Y g:i A', strtotime($order['created_at'])); ?> by <?php echo htmlspecialchars($order['username']); ?></p>
        </div>
        <a href="orders.php" class="btn-secondary"><i class="fa-solid fa-arrow-left"></i> Back to Orders</a>
    </div>

    <?php if (isset($_GET['saved'])): ?>
        <div class="flash">Order status updated.</div>
    <?php endif; ?>

    <div class="order-view-grid">

        <div class="admin-table-card order-view-items">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($order['items'] as $item): ?>
                    <tr>
                        <td>
                            <div style="display:flex; align-items:center; gap:14px;">
                                <img src="../<?php echo htmlspecialchars($item['image']); ?>" alt="" class="thumb">
                                <div class="product-name"><?php echo htmlspecialchars($item['product_name']); ?></div>
                            </div>
                        </td>
                        <td>₱<?php echo number_format((float)$item['price'], 2); ?></td>
                        <td><?php echo (int)$item['quantity']; ?></td>
                        <td>₱<?php echo number_format((float)$item['price'] * $item['quantity'], 2); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div class="order-view-totals">
                <div><span>Subtotal</span><span>₱<?php echo number_format((float)$order['subtotal'], 2); ?></span></div>
                <div><span>Shipping</span><span>₱<?php echo number_format((float)$order['shipping_fee'], 2); ?></span></div>
                <div class="order-view-grand-total"><span>Total</span><span>₱<?php echo number_format((float)$order['total'], 2); ?></span></div>
            </div>
        </div>

        <div class="admin-form order-view-side">

            <div class="form-section-label">Payment</div>
            <p><i class="fa-solid fa-money-bill-wave" style="color:#C7A66A;"></i> Cash on Delivery</p>

            <div class="form-section-label">Delivery To</div>
            <p><strong><?php echo htmlspecialchars($order['full_name']); ?></strong></p>
            <p><?php echo htmlspecialchars($order['phone']); ?></p>
            <p><?php echo htmlspecialchars($order['address']); ?>, <?php echo htmlspecialchars($order['city']); ?></p>
            <?php if (!empty($order['notes'])): ?>
                <p style="color:#999; font-size:13px;">Note: <?php echo htmlspecialchars($order['notes']); ?></p>
            <?php endif; ?>

            <div class="form-section-label">Status</div>
            <form method="POST">
                <div class="field">
                    <select name="status">
                        <?php foreach (['pending' => 'Pending', 'completed' => 'Completed', 'cancelled' => 'Cancelled'] as $val => $label): ?>
                            <option value="<?php echo $val; ?>" <?php echo $order['status'] === $val ? 'selected' : ''; ?>><?php echo $label; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button type="submit" class="btn-primary"><i class="fa-solid fa-check"></i> Update Status</button>
            </form>

        </div>

    </div>

</div>

</body>
</html>
