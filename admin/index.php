<?php
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../includes/auth.php';

requireAdmin();

$products = getAllProducts($pdo);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products | emPIEsema Admin</title>

    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="admin.css?v=7">
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
            <h1>Products</h1>
            <p class="sub"><?php echo count($products); ?> products in catalog</p>
        </div>
        <div style="display:flex; gap:12px;">
            <a href="mail_settings.php" class="btn-secondary"><i class="fa-solid fa-envelope"></i> Mail Settings</a>
            <a href="orders.php" class="btn-secondary"><i class="fa-solid fa-receipt"></i> Orders</a>
            <a href="product_form.php" class="btn-primary"><i class="fa-solid fa-plus"></i> Add Product</a>
        </div>
    </div>

    <?php if (isset($_GET['deleted'])): ?>
        <div class="flash">Product deleted.</div>
    <?php endif; ?>
    <?php if (isset($_GET['saved'])): ?>
        <div class="flash">Product saved.</div>
    <?php endif; ?>

    <div class="admin-table-card">

    <?php if (empty($products)): ?>

        <div class="admin-empty">No products yet. <a href="product_form.php" style="color:#C7A66A; font-weight:600;">Add your first product →</a></div>

    <?php else: ?>

        <table class="admin-table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Code</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Category</th>
                    <th>Featured</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $p): ?>
                <tr>
                    <td>
                        <div style="display:flex; align-items:center; gap:14px;">
                            <img src="../<?php echo htmlspecialchars($p['image']); ?>" alt="" class="thumb">
                            <div>
                                <div class="product-name"><?php echo htmlspecialchars($p['name']); ?></div>
                                <div style="font-size:12px; color:#999;">#<?php echo (int)$p['id']; ?></div>
                            </div>
                        </div>
                    </td>
                    <td><?php echo htmlspecialchars($p['code'] ?? '—'); ?></td>
                    <td>₱<?php echo number_format((float)$p['price'], 2); ?></td>
                    <td>
                        <?php $stock = (int)$p['stock']; ?>
                        <?php if ($stock === 0): ?>
                            <span class="badge badge-out-of-stock"><?php echo $stock; ?></span>
                        <?php elseif ($stock <= 3): ?>
                            <span class="badge badge-low-stock"><?php echo $stock; ?></span>
                        <?php else: ?>
                            <span class="badge badge-in-stock"><?php echo $stock; ?></span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if (!empty($p['category'])): ?>
                            <span class="badge badge-category"><?php echo htmlspecialchars($p['category']); ?></span>
                        <?php else: ?>
                            <span class="badge badge-none">—</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if ($p['featured']): ?>
                            <span class="badge badge-featured">Featured</span>
                        <?php else: ?>
                            <span class="badge badge-not-featured">No</span>
                        <?php endif; ?>
                    </td>
                    <td class="actions">
                        <a href="product_form.php?id=<?php echo (int)$p['id']; ?>"><i class="fa-solid fa-pen"></i> Edit</a>
                        <a href="../product.php?id=<?php echo (int)$p['id']; ?>" target="_blank"><i class="fa-solid fa-eye"></i> View</a>
                        <form method="POST" action="delete.php" onsubmit="return confirm('Delete this product?');" style="display:inline;">
                            <input type="hidden" name="id" value="<?php echo (int)$p['id']; ?>">
                            <button type="submit" class="link-danger"><i class="fa-solid fa-trash"></i> Delete</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    <?php endif; ?>

    </div>

</div>

<?php include __DIR__ . '/../includes/admin-footer.php'; ?>

</body>
</html>
