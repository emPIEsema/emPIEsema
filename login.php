<?php
require_once __DIR__ . '/includes/auth.php';

$explicitRedirect = isset($_GET['redirect']) || isset($_POST['redirect']);
$redirect = $_GET['redirect'] ?? $_POST['redirect'] ?? '/emPIEsema/index.php';
$error = '';

function loginDestination(string $redirect, bool $explicitRedirect): string
{
    // Admins land in the admin panel unless they were bounced here from a specific page.
    if (!$explicitRedirect && isAdmin()) {
        return '/emPIEsema/admin/index.php';
    }
    return $redirect;
}

if (isLoggedIn()) {
    header('Location: ' . loginDestination($redirect, $explicitRedirect));
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username === '' || $password === '') {
        $error = 'Please enter both username and password.';
    } else {
        $result = attemptLogin($pdo, $username, $password);
        if ($result === 'ok') {
            header('Location: ' . loginDestination($redirect, $explicitRedirect));
            exit;
        } elseif ($result === 'unverified') {
            $error = 'Please verify your email before logging in. Check your inbox for the verification link.';
        } else {
            $error = 'Invalid username or password.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | emPIEsema</title>

    <link rel="stylesheet" href="style.css?v=17">
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

            <h1 class="welcome-heading">Welcome</h1>
            <p class="auth-sub">Login with your account</p>

            <?php if ($error !== ''): ?>
                <div class="auth-error"><i class="fa-solid fa-circle-exclamation"></i> <?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>

            <input type="hidden" name="redirect" value="<?php echo htmlspecialchars($redirect); ?>">

            <div class="field-float">
                <label>Username</label>
                <div class="input-icon">
                    <i class="fa-regular fa-envelope"></i>
                    <input type="text" name="username" placeholder="username" value="<?php echo htmlspecialchars($_POST['username'] ?? ''); ?>" required autofocus>
                </div>
            </div>

            <div class="field-float">
                <label>Password</label>
                <div class="input-icon">
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" name="password" placeholder="••••••••••••" required>
                </div>
            </div>

            <a href="mailto:emPIEsema@gmail.com?subject=Password%20reset" class="forgot-link">Forgot your password?</a>

            <button type="submit" class="auth-submit">Login</button>

            <p class="auth-switch">Don't have an account? <a href="/emPIEsema/signup.php?redirect=<?php echo urlencode($redirect); ?>">Sign up</a></p>

            <a href="/emPIEsema/index.php" class="auth-back">← Back to shop</a>

        </form>

    </div>

</div>

<?php include __DIR__ . '/includes/site-footer.php'; ?>

</body>
</html>
