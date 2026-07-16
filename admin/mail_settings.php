<?php
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/mailer.php';

requireAdmin();

$errors = [];
$saved = false;

$settings = getMailSettings($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $settings['smtp_host'] = trim($_POST['smtp_host'] ?? '');
    $settings['smtp_port'] = trim($_POST['smtp_port'] ?? '');
    $settings['smtp_username'] = trim($_POST['smtp_username'] ?? '');
    $settings['smtp_password'] = trim($_POST['smtp_password'] ?? '');
    $settings['from_email'] = trim($_POST['from_email'] ?? '');
    $settings['from_name'] = trim($_POST['from_name'] ?? '');

    if ($settings['smtp_host'] === '' || $settings['smtp_username'] === '' || $settings['from_email'] === '') {
        $errors[] = 'SMTP host, username, and from email are required.';
    } elseif (!ctype_digit((string)$settings['smtp_port'])) {
        $errors[] = 'SMTP port must be a number.';
    } elseif (!filter_var($settings['from_email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'From email must be a valid email address.';
    } else {
        saveMailSettings($pdo, $settings);
        $saved = true;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mail Settings | emPIEsema Admin</title>

    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="admin.css?v=6">
</head>
<body>

<div class="admin-topbar">
    <div class="admin-brand">
        <span class="mark">emPIEsema</span>
        <span class="tag">Admin</span>
    </div>
    <div class="admin-user">
        <span>Logged in as <strong><?php echo htmlspecialchars(currentUsername()); ?></strong></span>
        <a href="../index.php" class="view-site" target="_blank">View Site</a>
        <a href="../logout.php" class="logout-link">Logout</a>
    </div>
</div>

<div class="admin-wrap">

    <form class="admin-form" method="POST">

        <h1>Mail Settings</h1>
        <p class="sub" style="margin-top:-8px; margin-bottom:20px;">SMTP credentials used to send account verification emails.</p>

        <?php if ($saved): ?>
            <div class="flash">Mail settings saved.</div>
        <?php endif; ?>

        <?php if (!empty($errors)): ?>
            <div class="error"><?php echo implode('<br>', array_map('htmlspecialchars', $errors)); ?></div>
        <?php endif; ?>

        <div class="form-section-label">SMTP Server</div>

        <div class="form-row">
            <div class="field">
                <label>SMTP Host *</label>
                <input type="text" name="smtp_host" value="<?php echo htmlspecialchars($settings['smtp_host']); ?>" placeholder="smtp.gmail.com" required>
            </div>
            <div class="field">
                <label>SMTP Port *</label>
                <input type="number" name="smtp_port" value="<?php echo htmlspecialchars((string)$settings['smtp_port']); ?>" required>
            </div>
        </div>

        <div class="form-row">
            <div class="field">
                <label>SMTP Username (Gmail address) *</label>
                <input type="text" name="smtp_username" value="<?php echo htmlspecialchars($settings['smtp_username']); ?>" placeholder="you@gmail.com" required>
            </div>
            <div class="field">
                <label>SMTP App Password *</label>
                <input type="password" name="smtp_password" value="<?php echo htmlspecialchars($settings['smtp_password']); ?>" placeholder="16-character app password" required>
            </div>
        </div>

        <small>Generate a Gmail app password at <a href="https://myaccount.google.com/apppasswords" target="_blank">myaccount.google.com/apppasswords</a> (requires 2-Step Verification).</small>

        <div class="form-section-label" style="margin-top:24px;">Sender Identity</div>

        <div class="form-row">
            <div class="field">
                <label>From Email *</label>
                <input type="email" name="from_email" value="<?php echo htmlspecialchars($settings['from_email']); ?>" placeholder="you@gmail.com" required>
            </div>
            <div class="field">
                <label>From Name</label>
                <input type="text" name="from_name" value="<?php echo htmlspecialchars($settings['from_name']); ?>" placeholder="emPIEsema">
            </div>
        </div>

        <button type="submit" class="btn-primary" style="margin-top:16px;">Save Settings</button>

    </form>

</div>

</body>
</html>
