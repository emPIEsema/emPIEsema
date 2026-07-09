<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/db.php';

function isLoggedIn(): bool
{
    return isset($_SESSION['account_id']);
}

function isAdmin(): bool
{
    return isLoggedIn() && ($_SESSION['role'] ?? '') === 'admin';
}

function currentUsername(): ?string
{
    return $_SESSION['username'] ?? null;
}

function attemptLogin(PDO $pdo, string $username, string $password): bool
{
    $stmt = $pdo->prepare('SELECT id, username, password_hash, role FROM accounts WHERE username = ?');
    $stmt->execute([$username]);
    $account = $stmt->fetch();

    if (!$account || !password_verify($password, $account['password_hash'])) {
        return false;
    }

    session_regenerate_id(true);
    $_SESSION['account_id'] = (int)$account['id'];
    $_SESSION['username'] = $account['username'];
    $_SESSION['role'] = $account['role'];

    return true;
}

function usernameExists(PDO $pdo, string $username): bool
{
    $stmt = $pdo->prepare('SELECT id FROM accounts WHERE username = ?');
    $stmt->execute([$username]);
    return (bool)$stmt->fetch();
}

function createAccount(PDO $pdo, string $username, string $password, string $role = 'customer'): int
{
    $stmt = $pdo->prepare('INSERT INTO accounts (username, password_hash, role) VALUES (?, ?, ?)');
    $stmt->execute([$username, password_hash($password, PASSWORD_DEFAULT), $role]);

    $id = (int)$pdo->lastInsertId();

    session_regenerate_id(true);
    $_SESSION['account_id'] = $id;
    $_SESSION['username'] = $username;
    $_SESSION['role'] = $role;

    return $id;
}

function logout(): void
{
    $_SESSION = [];
    session_destroy();
}

function requireLogin(string $redirectTo = null): void
{
    if (!isLoggedIn()) {
        $target = $redirectTo ?? ($_SERVER['REQUEST_URI'] ?? '');
        header('Location: /emPIEsema/login.php?redirect=' . urlencode($target));
        exit;
    }
}

function requireAdmin(): void
{
    if (!isLoggedIn()) {
        header('Location: /emPIEsema/login.php?redirect=' . urlencode($_SERVER['REQUEST_URI'] ?? ''));
        exit;
    }
    if (!isAdmin()) {
        http_response_code(403);
        die('Forbidden: admin access only.');
    }
}
