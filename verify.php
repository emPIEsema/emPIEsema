<?php
require_once __DIR__ . '/includes/auth.php';

$token = $_GET['token'] ?? '';
$success = $token !== '' && verifyAccount($pdo, $token);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Email | emPIEsema</title>

    <link rel="stylesheet" href="style.css?v=16">
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

        <div class="auth-card">

            <?php if ($success): ?>
                <h1 class="welcome-heading">Email Verified</h1>
                <p class="auth-sub">Your account is now active. You can log in.</p>
                <a href="/emPIEsema/login.php" class="auth-submit" style="display:block; text-align:center; margin-top:8px; text-decoration:none;">Go to Login</a>
            <?php else: ?>
                <h1 class="welcome-heading">Verification Failed</h1>
                <p class="auth-sub">This verification link is invalid or has already been used.</p>
                <a href="/emPIEsema/signup.php" class="auth-submit" style="display:block; text-align:center; margin-top:8px; text-decoration:none;">Back to Sign Up</a>
            <?php endif; ?>

            <a href="/emPIEsema/index.php" class="auth-back">← Back to shop</a>

        </div>

    </div>

</div>

</body>
</html>
