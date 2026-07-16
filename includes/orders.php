<?php

require_once __DIR__ . '/cart.php';

/**
 * Creates an order (with a snapshot of the current cart), decrements stock,
 * and empties the cart. Returns the new order id, or null if the cart is
 * empty or an item's stock ran out between page load and submit.
 */
function createOrder(PDO $pdo, int $accountId, array $address): ?int
{
    $items = getCartItems($pdo, $accountId);

    if (empty($items)) {
        return null;
    }

    foreach ($items as $item) {
        if ((int)$item['quantity'] > (int)$item['stock']) {
            return null;
        }
    }

    $subtotal = 0;
    foreach ($items as $item) {
        $subtotal += $item['price'] * $item['quantity'];
    }
    $shippingFee = 0;
    $total = $subtotal + $shippingFee;

    $pdo->beginTransaction();

    try {
        $insertOrder = $pdo->prepare(
            'INSERT INTO orders (account_id, full_name, phone, address, city, notes, payment_method, subtotal, shipping_fee, total)
             VALUES (:account_id, :full_name, :phone, :address, :city, :notes, :payment_method, :subtotal, :shipping_fee, :total)'
        );
        $insertOrder->execute([
            ':account_id' => $accountId,
            ':full_name' => $address['full_name'],
            ':phone' => $address['phone'],
            ':address' => $address['address'],
            ':city' => $address['city'],
            ':notes' => $address['notes'] !== '' ? $address['notes'] : null,
            ':payment_method' => 'cod',
            ':subtotal' => $subtotal,
            ':shipping_fee' => $shippingFee,
            ':total' => $total,
        ]);

        $orderId = (int)$pdo->lastInsertId();

        $insertItem = $pdo->prepare(
            'INSERT INTO order_items (order_id, product_id, product_name, image, price, quantity)
             VALUES (?, ?, ?, ?, ?, ?)'
        );
        $decrementStock = $pdo->prepare('UPDATE products SET stock = stock - ? WHERE id = ? AND stock >= ?');

        foreach ($items as $item) {
            $insertItem->execute([
                $orderId,
                $item['product_id'],
                $item['name'],
                $item['image'],
                $item['price'],
                $item['quantity'],
            ]);

            $decrementStock->execute([$item['quantity'], $item['product_id'], $item['quantity']]);

            if ($decrementStock->rowCount() === 0) {
                throw new RuntimeException('Stock changed before checkout could complete.');
            }
        }

        $clearCart = $pdo->prepare('DELETE FROM cart_items WHERE account_id = ?');
        $clearCart->execute([$accountId]);

        $pdo->commit();

        return $orderId;

    } catch (Throwable $e) {
        $pdo->rollBack();
        return null;
    }
}

function getOrderById(PDO $pdo, int $orderId, ?int $accountId = null): ?array
{
    $sql = 'SELECT o.*, a.username FROM orders o JOIN accounts a ON a.id = o.account_id WHERE o.id = ?';
    $params = [$orderId];

    if ($accountId !== null) {
        $sql .= ' AND o.account_id = ?';
        $params[] = $accountId;
    }

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $order = $stmt->fetch();

    if (!$order) {
        return null;
    }

    $itemsStmt = $pdo->prepare('SELECT * FROM order_items WHERE order_id = ? ORDER BY id');
    $itemsStmt->execute([$orderId]);
    $order['items'] = $itemsStmt->fetchAll();

    return $order;
}

function getAllOrders(PDO $pdo): array
{
    return $pdo->query(
        'SELECT o.*, a.username,
            (SELECT COUNT(*) FROM order_items oi WHERE oi.order_id = o.id) AS item_count
         FROM orders o
         JOIN accounts a ON a.id = o.account_id
         ORDER BY o.created_at DESC'
    )->fetchAll();
}

function updateOrderStatus(PDO $pdo, int $orderId, string $status): void
{
    $stmt = $pdo->prepare('UPDATE orders SET status = ? WHERE id = ?');
    $stmt->execute([$status, $orderId]);
}
