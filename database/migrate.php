<?php

$DB_HOST = 'localhost';
$DB_USER = 'root';
$DB_PASS = '';

header('Content-Type: text/plain');

try {
    $pdo = new PDO("mysql:host={$DB_HOST};charset=utf8mb4", $DB_USER, $DB_PASS, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);

    $schema = file_get_contents(__DIR__ . '/schema.sql');
    foreach (array_filter(array_map('trim', explode(';', $schema))) as $statement) {
        $pdo->exec($statement);
    }
    echo "Schema created.\n";

    $pdo->exec('USE empiesema');

    $products = require __DIR__ . '/empiesema_prod.php';

    $insertProduct = $pdo->prepare(
        'INSERT INTO products (id, name, code, price, image, status, color, material, dimensions, description, made, category, featured, stock)
         VALUES (:id, :name, :code, :price, :image, :status, :color, :material, :dimensions, :description, :made, :category, :featured, :stock)'
    );

    $insertSpec = $pdo->prepare(
        'INSERT INTO product_specs (product_id, spec, column_no) VALUES (:product_id, :spec, :column_no)'
    );

    $count = 0;
    foreach ($products as $id => $p) {
        $insertProduct->execute([
            ':id' => $id,
            ':name' => $p['name'],
            ':code' => $p['code'] ?? null,
            ':price' => $p['price'],
            ':image' => $p['image'] ?? null,
            ':status' => $p['status'] ?? null,
            ':color' => $p['color'] ?? null,
            ':material' => $p['material'] ?? null,
            ':dimensions' => $p['dimensions'] ?? null,
            ':description' => $p['description'] ?? null,
            ':made' => $p['made'] ?? null,
            ':category' => $p['category'] ?? null,
            ':featured' => $p['featured'] ?? 0,
            ':stock' => $p['stock'] ?? 3,
        ]);

        foreach (($p['left_specs'] ?? []) as $spec) {
            $insertSpec->execute([':product_id' => $id, ':spec' => $spec, ':column_no' => 1]);
        }
        foreach (($p['right_specs'] ?? []) as $spec) {
            $insertSpec->execute([':product_id' => $id, ':spec' => $spec, ':column_no' => 2]);
        }

        $count++;
    }

    $pdo->exec('ALTER TABLE products AUTO_INCREMENT = ' . (max(array_keys($products)) + 1));

    echo "Inserted {$count} products with specs.\n";

    $adminHash = password_hash('admin123', PASSWORD_DEFAULT);
    $seedAdmin = $pdo->prepare(
        'INSERT INTO accounts (username, password_hash, role, email_verified) VALUES (:username, :hash, :role, 1)
         ON DUPLICATE KEY UPDATE password_hash = :hash2, role = :role2, email_verified = 1'
    );
    $seedAdmin->execute([
        ':username' => 'emPIEsema1',
        ':hash' => $adminHash,
        ':role' => 'admin',
        ':hash2' => $adminHash,
        ':role2' => 'admin',
    ]);
    echo "Admin account ready (emPIEsema1 / admin123).\n";

    echo "Migration complete.\n";

} catch (PDOException $e) {
    http_response_code(500);
    echo 'Migration failed: ' . $e->getMessage() . "\n";
}
