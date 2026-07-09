<?php
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../includes/auth.php';

requireAdmin();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    deleteProduct($pdo, (int)$_POST['id']);
}

header('Location: index.php?deleted=1');
exit;
