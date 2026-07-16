<?php

require_once __DIR__ . '/db-config.php';

// ── Site base URL ─────────────────────────────────────────────────
// Auto-detects whether the site lives at the domain root (live host)
// or in a subfolder (e.g. XAMPP's /emPIEsema/), so links work in both
// places without editing anything.
if (!defined('BASE_URL')) {
    $documentRoot = rtrim(str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT'] ?? ''), '/');
    $siteRoot = rtrim(str_replace('\\', '/', dirname(__DIR__)), '/');
    define('BASE_URL', substr($siteRoot, strlen($documentRoot)));
}

try {
    $pdo = new PDO(
        "mysql:host={$DB_HOST};dbname={$DB_NAME};charset=utf8mb4",
        $DB_USER,
        $DB_PASS,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]
    );
} catch (PDOException $e) {
    die('Database connection failed: ' . $e->getMessage() . ' — run database/migrate.php first to create the database.');
}
