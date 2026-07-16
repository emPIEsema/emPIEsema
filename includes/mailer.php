<?php

require_once __DIR__ . '/PHPMailer/PHPMailer.php';
require_once __DIR__ . '/PHPMailer/SMTP.php';
require_once __DIR__ . '/PHPMailer/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;

// getMailSettings
function getMailSettings(PDO $pdo): array
{
    $stmt = $pdo->query('SELECT smtp_host, smtp_port, smtp_username, smtp_password, from_email, from_name FROM mail_settings WHERE id = 1');
    return $stmt->fetch() ?: [
        'smtp_host' => 'smtp.gmail.com', 'smtp_port' => 587,
        'smtp_username' => '', 'smtp_password' => '',
        'from_email' => '', 'from_name' => 'emPIEsema',
    ];
}

// saveMailSettings
function saveMailSettings(PDO $pdo, array $settings): void
{
    $stmt = $pdo->prepare(
        'UPDATE mail_settings SET smtp_host = ?, smtp_port = ?, smtp_username = ?, smtp_password = ?, from_email = ?, from_name = ? WHERE id = 1'
    );
    $stmt->execute([
        $settings['smtp_host'], $settings['smtp_port'], $settings['smtp_username'],
        $settings['smtp_password'], $settings['from_email'], $settings['from_name'],
    ]);
}

// sendVerificationEmail
function sendVerificationEmail(PDO $pdo, string $toEmail, string $toName, string $verifyUrl): bool
{
    $config = getMailSettings($pdo);

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = $config['smtp_host'];
        $mail->SMTPAuth = true;
        $mail->Username = $config['smtp_username'];
        $mail->Password = $config['smtp_password'];
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = (int)$config['smtp_port'];

        $mail->setFrom($config['from_email'], $config['from_name']);
        $mail->addAddress($toEmail, $toName);

        $mail->isHTML(true);
        $mail->Subject = 'Verify your emPIEsema account';
        $mail->Body = '<p>Hi ' . htmlspecialchars($toName) . ',</p>'
            . '<p>Thanks for signing up for emPIEsema. Please verify your email address by clicking the link below:</p>'
            . '<p><a href="' . htmlspecialchars($verifyUrl) . '">' . htmlspecialchars($verifyUrl) . '</a></p>'
            . '<p>If you did not create this account, you can ignore this email.</p>';
        $mail->AltBody = "Verify your email: {$verifyUrl}";

        $mail->send();
        return true;
    } catch (Exception $e) {
        error_log('Verification email failed: ' . $mail->ErrorInfo);
        return false;
    }
}
