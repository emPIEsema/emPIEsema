<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/db.php';

<<<<<<< HEAD
// isLoggedIn
=======
<<<<<<< HEAD
// isLoggedIn
=======
>>>>>>> 0c6d304ba7fa2b3aabd4388a295d8bbe207c534a
>>>>>>> 7630a55c3b37e16000825c99b1d344a7d9e4d13a
function isLoggedIn(): bool
{
    return isset($_SESSION['account_id']);
}

<<<<<<< HEAD
// isAdmin
=======
<<<<<<< HEAD
// isAdmin
=======
>>>>>>> 0c6d304ba7fa2b3aabd4388a295d8bbe207c534a
>>>>>>> 7630a55c3b37e16000825c99b1d344a7d9e4d13a
function isAdmin(): bool
{
    return isLoggedIn() && ($_SESSION['role'] ?? '') === 'admin';
}

<<<<<<< HEAD
// currentUsername
=======
<<<<<<< HEAD
// currentUsername
=======
>>>>>>> 0c6d304ba7fa2b3aabd4388a295d8bbe207c534a
>>>>>>> 7630a55c3b37e16000825c99b1d344a7d9e4d13a
function currentUsername(): ?string
{
    return $_SESSION['username'] ?? null;
}

<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> 7630a55c3b37e16000825c99b1d344a7d9e4d13a
// attemptLogin
function attemptLogin(PDO $pdo, string $username, string $password): string
{
    $stmt = $pdo->prepare('SELECT id, username, password_hash, role, email_verified FROM accounts WHERE username = ?');
<<<<<<< HEAD
=======
=======
function attemptLogin(PDO $pdo, string $username, string $password): bool
{
    $stmt = $pdo->prepare('SELECT id, username, password_hash, role FROM accounts WHERE username = ?');
>>>>>>> 0c6d304ba7fa2b3aabd4388a295d8bbe207c534a
>>>>>>> 7630a55c3b37e16000825c99b1d344a7d9e4d13a
    $stmt->execute([$username]);
    $account = $stmt->fetch();

    if (!$account || !password_verify($password, $account['password_hash'])) {
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> 7630a55c3b37e16000825c99b1d344a7d9e4d13a
        return 'invalid';
    }

    if (!$account['email_verified']) {
        return 'unverified';
<<<<<<< HEAD
=======
=======
        return false;
>>>>>>> 0c6d304ba7fa2b3aabd4388a295d8bbe207c534a
>>>>>>> 7630a55c3b37e16000825c99b1d344a7d9e4d13a
    }

    session_regenerate_id(true);
    $_SESSION['account_id'] = (int)$account['id'];
    $_SESSION['username'] = $account['username'];
    $_SESSION['role'] = $account['role'];

<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> 7630a55c3b37e16000825c99b1d344a7d9e4d13a
    return 'ok';
}

// usernameExists
<<<<<<< HEAD
=======
=======
    return true;
}

>>>>>>> 0c6d304ba7fa2b3aabd4388a295d8bbe207c534a
>>>>>>> 7630a55c3b37e16000825c99b1d344a7d9e4d13a
function usernameExists(PDO $pdo, string $username): bool
{
    $stmt = $pdo->prepare('SELECT id FROM accounts WHERE username = ?');
    $stmt->execute([$username]);
    return (bool)$stmt->fetch();
}

<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> 7630a55c3b37e16000825c99b1d344a7d9e4d13a
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
<<<<<<< HEAD
=======
=======
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

>>>>>>> 0c6d304ba7fa2b3aabd4388a295d8bbe207c534a
>>>>>>> 7630a55c3b37e16000825c99b1d344a7d9e4d13a
function logout(): void
{
    $_SESSION = [];
    session_destroy();
}

<<<<<<< HEAD
// requireLogin
=======
<<<<<<< HEAD
// requireLogin
=======
>>>>>>> 0c6d304ba7fa2b3aabd4388a295d8bbe207c534a
>>>>>>> 7630a55c3b37e16000825c99b1d344a7d9e4d13a
function requireLogin(string $redirectTo = null): void
{
    if (!isLoggedIn()) {
        $target = $redirectTo ?? ($_SERVER['REQUEST_URI'] ?? '');
        header('Location: /emPIEsema/login.php?redirect=' . urlencode($target));
        exit;
    }
}

<<<<<<< HEAD
// requireAdmin
=======
<<<<<<< HEAD
// requireAdmin
=======
>>>>>>> 0c6d304ba7fa2b3aabd4388a295d8bbe207c534a
>>>>>>> 7630a55c3b37e16000825c99b1d344a7d9e4d13a
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
