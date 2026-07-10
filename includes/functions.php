<?php

require_once __DIR__ . '/db.php';

function attachSpecs(PDO $pdo, array $product): array
{
    $stmt = $pdo->prepare('SELECT spec, column_no FROM product_specs WHERE product_id = ? ORDER BY id');
    $stmt->execute([$product['id']]);

    $product['left_specs'] = [];
    $product['right_specs'] = [];

    foreach ($stmt->fetchAll() as $row) {
        if ((int)$row['column_no'] === 1) {
            $product['left_specs'][] = $row['spec'];
        } else {
            $product['right_specs'][] = $row['spec'];
        }
    }

    return $product;
}

function getAllProducts(PDO $pdo): array
{
    return $pdo->query('SELECT * FROM products ORDER BY id')->fetchAll();
}

function getProductById(PDO $pdo, int $id): ?array
{
    $stmt = $pdo->prepare('SELECT * FROM products WHERE id = ?');
    $stmt->execute([$id]);
    $product = $stmt->fetch();

    if (!$product) {
        return null;
    }

    return attachSpecs($pdo, $product);
}

function getProductsByCategory(PDO $pdo, string $category): array
{
    $stmt = $pdo->prepare('SELECT * FROM products WHERE category = ? ORDER BY id');
    $stmt->execute([$category]);
    return $stmt->fetchAll();
}

function getFeaturedProducts(PDO $pdo): array
{
    return $pdo->query('SELECT * FROM products WHERE featured = 1 ORDER BY id')->fetchAll();
}

function searchProducts(PDO $pdo, string $q): array
{
    $stmt = $pdo->prepare(
        'SELECT * FROM products WHERE name LIKE :q OR code LIKE :q OR description LIKE :q ORDER BY name'
    );
    $stmt->execute([':q' => '%' . $q . '%']);
    return $stmt->fetchAll();
}

function createProduct(PDO $pdo, array $data, array $leftSpecs = [], array $rightSpecs = []): int
{
    $stmt = $pdo->prepare(
        'INSERT INTO products (name, code, price, image, status, color, material, dimensions, description, made, category, featured, stock)
         VALUES (:name, :code, :price, :image, :status, :color, :material, :dimensions, :description, :made, :category, :featured, :stock)'
    );
    $stmt->execute($data);

    $id = (int)$pdo->lastInsertId();
    saveProductSpecs($pdo, $id, $leftSpecs, $rightSpecs);

    return $id;
}

function updateProduct(PDO $pdo, int $id, array $data, array $leftSpecs = [], array $rightSpecs = []): void
{
    $data[':id'] = $id;

    $stmt = $pdo->prepare(
        'UPDATE products SET
            name = :name, code = :code, price = :price, image = :image,
            status = :status, color = :color, material = :material,
            dimensions = :dimensions, description = :description, made = :made,
            category = :category, featured = :featured, stock = :stock
         WHERE id = :id'
    );
    $stmt->execute($data);

    saveProductSpecs($pdo, $id, $leftSpecs, $rightSpecs);
}

function saveProductSpecs(PDO $pdo, int $productId, array $leftSpecs, array $rightSpecs): void
{
    $del = $pdo->prepare('DELETE FROM product_specs WHERE product_id = ?');
    $del->execute([$productId]);

    $insert = $pdo->prepare('INSERT INTO product_specs (product_id, spec, column_no) VALUES (?, ?, ?)');

    foreach ($leftSpecs as $spec) {
        $spec = trim($spec);
        if ($spec !== '') {
            $insert->execute([$productId, $spec, 1]);
        }
    }
    foreach ($rightSpecs as $spec) {
        $spec = trim($spec);
        if ($spec !== '') {
            $insert->execute([$productId, $spec, 2]);
        }
    }
}

function deleteProduct(PDO $pdo, int $id): void
{
    $stmt = $pdo->prepare('DELETE FROM products WHERE id = ?');
    $stmt->execute([$id]);
}
