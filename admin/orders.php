<?php
require_once __DIR__ . '/../includes/orders.php';

requireAdmin();

$orders = getAllOrders($pdo);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders | emPIEsema Admin</title>

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
            <h1>Orders</h1>
            <p class="sub"><?php echo count($orders); ?> orders placed</p>
        </div>
        <a href="index.php" class="btn-secondary"><i class="fa-solid fa-box"></i> Products</a>
    </div>

    <div class="admin-table-card">

    <?php if (empty($orders)): ?>

        <div class="admin-empty">No orders have been placed yet.</div>

    <?php else: ?>

        <table class="admin-table">
            <thead>
                <tr>
                    <th>Order</th>
                    <th>Customer</th>
                    <th>Delivery Address</th>
                    <th>Items</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Placed</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $o): ?>
                <tr>
                    <td>#<?php echo (int)$o['id']; ?></td>
                    <td>
                        <div class="product-name"><?php echo htmlspecialchars($o['full_name']); ?></div>
                        <div style="font-size:12px; color:#999;"><?php echo htmlspecialchars($o['username']); ?> · <?php echo htmlspecialchars($o['phone']); ?></div>
                    </td>
                    <td style="max-width:220px;"><?php echo htmlspecialchars($o['address']); ?>, <?php echo htmlspecialchars($o['city']); ?></td>
                    <td><?php echo (int)$o['item_count']; ?></td>
                    <td>₱<?php echo number_format((float)$o['total'], 2); ?></td>
                    <td>
                        <span class="badge badge-status-<?php echo htmlspecialchars($o['status']); ?>"><?php echo htmlspecialchars(ucfirst($o['status'])); ?></span>
                    </td>
                    <td style="font-size:12px; color:#777;"><?php echo date('M j, Y g:i A', strtotime($o['created_at'])); ?></td>
                    <td class="actions">
                        <a href="order_view.php?id=<?php echo (int)$o['id']; ?>"><i class="fa-solid fa-eye"></i> View</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    <?php endif; ?>

    </div>

</div>

</body>
</html>
