<?php

require_once __DIR__ . '/auth.php';

function getProductStock(PDO $pdo, int $productId): int
{
    $stmt = $pdo->prepare('SELECT stock FROM products WHERE id = ?');
    $stmt->execute([$productId]);
    $stock = $stmt->fetchColumn();
    return $stock === false ? 0 : (int)$stock;
}

/**
 * Adds qty to the cart, capped at the product's available stock.
 * Returns 'added' (full amount added), 'capped' (partially or not added due to stock), or 'out_of_stock'.
 */
function addToCart(PDO $pdo, int $accountId, int $productId, int $qty = 1): string
{
    $stock = getProductStock($pdo, $productId);

    if ($stock <= 0) {
        return 'out_of_stock';
    }

    $existing = $pdo->prepare('SELECT quantity FROM cart_items WHERE account_id = ? AND product_id = ?');
    $existing->execute([$accountId, $productId]);
    $currentQty = (int)($existing->fetchColumn() ?: 0);

    $desiredQty = $currentQty + $qty;
    $newQty = min($desiredQty, $stock);

    if ($newQty === $currentQty) {
        return 'capped';
    }

    $stmt = $pdo->prepare(
        'INSERT INTO cart_items (account_id, product_id, quantity) VALUES (?, ?, ?)
         ON DUPLICATE KEY UPDATE quantity = ?'
    );
    $stmt->execute([$accountId, $productId, $newQty, $newQty]);

    return $newQty < $desiredQty ? 'capped' : 'added';
}

function updateCartQty(PDO $pdo, int $accountId, int $productId, int $qty): void
{
    if ($qty <= 0) {
        removeFromCart($pdo, $accountId, $productId);
        return;
    }

    $stock = getProductStock($pdo, $productId);
    $qty = min($qty, $stock);

    if ($qty <= 0) {
        removeFromCart($pdo, $accountId, $productId);
        return;
    }

    $stmt = $pdo->prepare('UPDATE cart_items SET quantity = ? WHERE account_id = ? AND product_id = ?');
    $stmt->execute([$qty, $accountId, $productId]);
}

function removeFromCart(PDO $pdo, int $accountId, int $productId): void
{
    $stmt = $pdo->prepare('DELETE FROM cart_items WHERE account_id = ? AND product_id = ?');
    $stmt->execute([$accountId, $productId]);
}

function getCartItems(PDO $pdo, int $accountId): array
{
    $stmt = $pdo->prepare(
        'SELECT ci.product_id, ci.quantity, p.name, p.price, p.image, p.stock
         FROM cart_items ci
         JOIN products p ON p.id = ci.product_id
         WHERE ci.account_id = ?
         ORDER BY ci.id'
    );
    $stmt->execute([$accountId]);
    return $stmt->fetchAll();
}

function getCartCount(PDO $pdo, ?int $accountId): int
{
    if (!$accountId) {
        return 0;
    }
    $stmt = $pdo->prepare('SELECT COALESCE(SUM(quantity), 0) FROM cart_items WHERE account_id = ?');
    $stmt->execute([$accountId]);
    return (int)$stmt->fetchColumn();
}
