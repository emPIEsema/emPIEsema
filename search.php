<?php
require_once __DIR__ . '/includes/functions.php';

$q = trim($_GET['q'] ?? '');
$results = $q !== '' ? searchProducts($pdo, $q) : [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search<?php echo $q !== '' ? ' — ' . htmlspecialchars($q) : ''; ?> | emPIEsema</title>

    <link rel="stylesheet" href="style.css?v=8">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body>

<?php include __DIR__ . '/includes/header.php'; ?>

<section class="collection-page">

    <div class="collection-header">
        <?php if ($q === ''): ?>
            <h1>Search</h1>
            <p>Type something in the search bar above to find products.</p>
        <?php else: ?>
            <h1>Results for "<?php echo htmlspecialchars($q); ?>"</h1>
            <p><?php echo count($results); ?> product<?php echo count($results) === 1 ? '' : 's'; ?> found</p>
        <?php endif; ?>
    </div>

    <?php if ($q !== '' && empty($results)): ?>
        <p class="cart-empty">No products matched your search. <a href="/emPIEsema/shop.php">Browse the shop →</a></p>
    <?php endif; ?>

    <div class="product-grid collection-grid">

        <?php foreach ($results as $p): ?>
        <div class="card">
            <a href="product.php?id=<?php echo (int)$p['id']; ?>" class="product-link">
                <img src="<?php echo htmlspecialchars($p['image']); ?>" alt="<?php echo htmlspecialchars($p['name']); ?>">
            </a>
            <h3><?php echo htmlspecialchars($p['name']); ?></h3>
            <p>₱<?php echo number_format((float)$p['price'], 2); ?></p>
        </div>
        <?php endforeach; ?>

    </div>

</section>

</body>
</html>
