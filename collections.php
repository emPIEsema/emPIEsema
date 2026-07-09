<?php
require_once __DIR__ . '/includes/functions.php';

$products = getAllProducts($pdo);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Collections | emPIEsema</title>

    <link rel="stylesheet" href="style.css?v=8">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body>

<?php include __DIR__ . '/includes/header.php'; ?>

<section class="collection-page">

    <div class="collection-header">
        <h1>All Collections</h1>
        <p><?php echo count($products); ?> products</p>
    </div>

    <div class="product-grid collection-grid">

        <?php foreach ($products as $p): ?>
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
