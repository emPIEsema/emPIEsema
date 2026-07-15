<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/db.php';

// isLoggedIn
function isLoggedIn(): bool
{
    return isset($_SESSION['account_id']);
}

// isAdmin
function isAdmin(): bool
{
    return isLoggedIn() && ($_SESSION['role'] ?? '') === 'admin';
}

// currentUsername
function currentUsername(): ?string
{
    return $_SESSION['username'] ?? null;
}

// attemptLogin
function attemptLogin(PDO $pdo, string $username, string $password): string
{
    $stmt = $pdo->prepare('SELECT id, username, password_hash, role, email_verified FROM accounts WHERE username = ?');
    $stmt->execute([$username]);
    $account = $stmt->fetch();

    if (!$account || !password_verify($password, $account['password_hash'])) {
        return 'invalid';
    }

    if (!$account['email_verified']) {
        return 'unverified';
    }

    session_regenerate_id(true);
    $_SESSION['account_id'] = (int)$account['id'];
    $_SESSION['username'] = $account['username'];
    $_SESSION['role'] = $account['role'];

    return 'ok';
}

// usernameExists
function usernameExists(PDO $pdo, string $username): bool
{
    $stmt = $pdo->prepare('SELECT id FROM accounts WHERE username = ?');
    $stmt->execute([$username]);
    return (bool)$stmt->fetch();
}

// createAccount
function createAccount(PDO $pdo, string $username, string $password, string $role = 'customer', string $firstName = '', string $lastName = '', string $email = ''): array
{
    $token = bin2hex(random_bytes(32));

    $stmt = $pdo->prepare('INSERT INTO accounts (username, password_hash, role, first_name, last_name, email, verification_token) VALUES (?, ?, ?, ?, ?, ?, ?)');
    $stmt->execute([$username, password_hash($password, PASSWORD_DEFAULT), $role, $firstName, $lastName, $email, $token]);

    return ['id' => (int)$pdo->lastInsertId(), 'token' => $token];
}

// verifyAccount
function verifyAccount(PDO $pdo, string $token): bool
{
    $stmt = $pdo->prepare('SELECT id FROM accounts WHERE verification_token = ?');
    $stmt->execute([$token]);
    $account = $stmt->fetch();

    if (!$account) {
        return false;
    }

    $upd = $pdo->prepare('UPDATE accounts SET email_verified = 1, verification_token = NULL WHERE id = ?');
    $upd->execute([$account['id']]);

    return true;
}

// logout
function logout(): void
{
    $_SESSION = [];
    session_destroy();
}

// requireLogin
function requireLogin(string $redirectTo = null): void
{
    if (!isLoggedIn()) {
        $target = $redirectTo ?? ($_SERVER['REQUEST_URI'] ?? '');
        header('Location: /emPIEsema/login.php?redirect=' . urlencode($target));
        exit;
    }
}

// requireAdmin
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
