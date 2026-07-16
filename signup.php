<?php
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/mailer.php';

$redirect = $_GET['redirect'] ?? $_POST['redirect'] ?? '/emPIEsema/index.php';
$error = '';
$success = false;
$username = '';
$firstName = '';
$lastName = '';
$email = '';

if (isLoggedIn()) {
    header('Location: ' . $redirect);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $firstName = trim($_POST['first_name'] ?? '');
    $lastName = trim($_POST['last_name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm = $_POST['confirm_password'] ?? '';

    if ($username === '' || $firstName === '' || $lastName === '' || $email === '' || $password === '' || $confirm === '') {
        $error = 'Please fill in all fields.';
    } elseif (strlen($username) < 3) {
        $error = 'Username must be at least 3 characters.';
    } elseif (!preg_match('/^[A-Za-z\s]+$/', $firstName) || !preg_match('/^[A-Za-z\s]+$/', $lastName)) {
        $error = 'First and last name must not contain numbers or symbols.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Please enter a valid email address.';
    } elseif (strlen($password) < 6) {
        $error = 'Password must be at least 6 characters.';
    } elseif ($password !== $confirm) {
        $error = 'Passwords do not match.';
    } elseif (usernameExists($pdo, $username)) {
        $error = 'That username is already taken.';
    } else {
        $account = createAccount($pdo, $username, $password, 'customer', $firstName, $lastName, $email);

        $verifyUrl = (isset($_SERVER['HTTPS']) ? 'https://' : 'http://') . $_SERVER['HTTP_HOST']
            . '/emPIEsema/verify.php?token=' . urlencode($account['token']);

        if (sendVerificationEmail($pdo, $email, $firstName, $verifyUrl)) {
            $success = true;
        } else {
            $error = 'Account created, but we could not send the verification email. Please contact support.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up | emPIEsema</title>

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

        <?php if ($success): ?>
        <div class="auth-card">

            <h1 class="welcome-heading">Check Your Email</h1>
            <p class="auth-sub">We sent a verification link to <strong><?php echo htmlspecialchars($email); ?></strong>. Click it to activate your account before logging in.</p>

            <a href="/emPIEsema/login.php?redirect=<?php echo urlencode($redirect); ?>" class="auth-submit" style="display:block; text-align:center; margin-top:8px; text-decoration:none;">Go to Login</a>

            <a href="/emPIEsema/index.php" class="auth-back">← Back to shop</a>

        </div>
        <?php else: ?>
        <form class="auth-card" method="POST">

            <h1 class="welcome-heading">Join Us</h1>
            <p class="auth-sub">Create an account to shop and check out faster</p>

            <?php if ($error !== ''): ?>
                <div class="auth-error"><i class="fa-solid fa-circle-exclamation"></i> <?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>

            <input type="hidden" name="redirect" value="<?php echo htmlspecialchars($redirect); ?>">

            <div class="field-float">
                <label>First Name</label>
                <div class="input-icon">
                    <i class="fa-regular fa-user"></i>
                    <input type="text" name="first_name" placeholder="Your first name" value="<?php echo htmlspecialchars($firstName); ?>" required autofocus pattern="[A-Za-z\s]+" title="First name must contain letters only, no numbers.">
                </div>
            </div>

            <div class="field-float">
                <label>Last Name</label>
                <div class="input-icon">
                    <i class="fa-regular fa-user"></i>
                    <input type="text" name="last_name" placeholder="Your last name" value="<?php echo htmlspecialchars($lastName); ?>" required pattern="[A-Za-z\s]+" title="Last name must contain letters only, no numbers.">
                </div>
            </div>

            <div class="field-float">
                <label>Email</label>
                <div class="input-icon">
                    <i class="fa-regular fa-envelope"></i>
                    <input type="email" name="email" placeholder="you@example.com" value="<?php echo htmlspecialchars($email); ?>" required>
                </div>
            </div>

            <div class="field-float">
                <label>Username</label>
                <div class="input-icon">
                    <i class="fa-regular fa-envelope"></i>
                    <input type="text" name="username" placeholder="Choose a username" value="<?php echo htmlspecialchars($username); ?>" required minlength="3">
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
        <?php endif; ?>

    </div>

</div>

<?php include __DIR__ . '/includes/site-footer.php'; ?>

</body>
</html>
