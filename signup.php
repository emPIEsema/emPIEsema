<?php
require_once __DIR__ . '/includes/auth.php';

$redirect = $_GET['redirect'] ?? $_POST['redirect'] ?? '/emPIEsema/index.php';
$error = '';
$username = '';

if (isLoggedIn()) {
    header('Location: ' . $redirect);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm = $_POST['confirm_password'] ?? '';

    if ($username === '' || $password === '' || $confirm === '') {
        $error = 'Please fill in all fields.';
    } elseif (strlen($username) < 3) {
        $error = 'Username must be at least 3 characters.';
    } elseif (strlen($password) < 6) {
        $error = 'Password must be at least 6 characters.';
    } elseif ($password !== $confirm) {
        $error = 'Passwords do not match.';
    } elseif (usernameExists($pdo, $username)) {
        $error = 'That username is already taken.';
    } else {
        createAccount($pdo, $username, $password, 'customer');
        header('Location: ' . $redirect);
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up | emPIEsema</title>

    <link rel="stylesheet" href="style.css?v=8">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body>

<div class="auth-page">

    <div class="auth-panel">

        <div class="auth-visual">
            <img src="images/hero.avif" alt="emPIEsema">
            <div class="auth-visual-overlay">
                <span class="auth-visual-brand">emPIEsema</span>
                <p class="auth-visual-tagline">Every Journey. Every Bag. Every You.</p>
                <i class="fa-solid fa-suitcase-rolling auth-deco auth-deco-left"></i>
                <i class="fa-solid fa-bag-shopping auth-deco auth-deco-right"></i>
            </div>
        </div>

        <form class="auth-card" method="POST">

            <h1 class="welcome-heading">Join Us</h1>
            <p class="auth-sub">Create an account to shop and check out faster</p>

            <?php if ($error !== ''): ?>
                <div class="auth-error"><i class="fa-solid fa-circle-exclamation"></i> <?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>

            <input type="hidden" name="redirect" value="<?php echo htmlspecialchars($redirect); ?>">

            <div class="field-float">
                <label>Username</label>
                <div class="input-icon">
                    <i class="fa-regular fa-envelope"></i>
                    <input type="text" name="username" placeholder="Choose a username" value="<?php echo htmlspecialchars($username); ?>" required autofocus minlength="3">
                </div>
            </div>

            <div class="field-float">
                <label>Password</label>
                <div class="input-icon">
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" name="password" placeholder="At least 6 characters" required minlength="6">
                </div>
            </div>

            <div class="field-float">
                <label>Confirm Password</label>
                <div class="input-icon">
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" name="confirm_password" placeholder="Re-enter your password" required minlength="6">
                </div>
            </div>

            <button type="submit" class="auth-submit" style="margin-top:8px;">Create Account</button>

            <p class="auth-switch">Already have an account? <a href="/emPIEsema/login.php?redirect=<?php echo urlencode($redirect); ?>">Sign in</a></p>

            <a href="/emPIEsema/index.php" class="auth-back">← Back to shop</a>

        </form>

    </div>

</div>

</body>
</html>
