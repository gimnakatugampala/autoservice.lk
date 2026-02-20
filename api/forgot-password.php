<?php
header('Content-Type: application/json');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once '../includes/db_config.php';
require_once '../vendor/autoload.php';

use GuzzleHttp\Client;
use SendinBlue\Client\Configuration;
use SendinBlue\Client\Api\TransactionalEmailsApi;
use SendinBlue\Client\Model\SendSmtpEmail;

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
    exit;
}

$input = json_decode(file_get_contents('php://input'), true);
$email = trim($input['email'] ?? '');

if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['success' => false, 'message' => 'Please provide a valid email address.']);
    exit;
}

// ── 1. Look up employee by email ───────────────────────────────────────────
$stmt = $conn->prepare("SELECT id, first_name, last_name, email FROM employee WHERE email = ? AND is_active = 1 LIMIT 1");
$stmt->bind_param("s", $email);
$stmt->execute();
$employee = $stmt->get_result()->fetch_assoc();
$stmt->close();

// Always return success to prevent email enumeration attacks
if (!$employee) {
    echo json_encode([
        'success' => true,
        'message' => 'If that email is registered, a reset link has been sent.'
    ]);
    exit;
}

// ── 2. Build display name safely (first_name / last_name can be NULL in DB) ─
$recipientName = trim(($employee['first_name'] ?? '') . ' ' . ($employee['last_name'] ?? ''));
if ($recipientName === '') {
    $recipientName = 'Employee'; // fallback when both columns are NULL
}

// ── 3. Generate a secure token ─────────────────────────────────────────────
$token      = bin2hex(random_bytes(32));     // 64-char hex, sent in URL
$token_hash = hash('sha256', $token);        // only the hash is stored in DB
$expires_at = date('Y-m-d H:i:s', time() + 3600); // expires in 1 hour

// ── 4. Store token — replace any existing one for this employee ────────────
$stmt = $conn->prepare("DELETE FROM employee_password_resets WHERE employee_id = ?");
$stmt->bind_param("i", $employee['id']);
$stmt->execute();
$stmt->close();

$stmt = $conn->prepare("INSERT INTO employee_password_resets (employee_id, token_hash, expires_at) VALUES (?, ?, ?)");
$stmt->bind_param("iss", $employee['id'], $token_hash, $expires_at);
if (!$stmt->execute()) {
    echo json_encode(['success' => false, 'message' => 'Could not generate reset token. Please try again.']);
    $stmt->close();
    exit;
}
$stmt->close();

// ── 5. Build reset URL ─────────────────────────────────────────────────────
$protocol  = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
$host      = $_SERVER['HTTP_HOST'];
$reset_url = $protocol . '://' . $host . '/autoservice/auth/reset-password.php?token=' . $token;

// ── 6. Send email via Brevo ────────────────────────────────────────────────
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$config      = Configuration::getDefaultConfiguration()->setApiKey('api-key', $_ENV['BREVO_API_KEY']);
$apiInstance = new TransactionalEmailsApi(new Client(), $config);
$mail        = new SendSmtpEmail();

$mail['sender'] = [
    'name'  => 'autoService.lk',
    'email' => 'no-reply@autoserviceapp.online'
];

$mail['to'] = [
    ['email' => $employee['email'], 'name' => $recipientName]
];

$mail['subject'] = 'Reset Your Password — autoService.lk';

$mail['htmlContent'] = '
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body        { font-family: Arial, sans-serif; background: #f4f6f9; margin: 0; padding: 0; }
        .wrapper    { max-width: 520px; margin: 40px auto; background: #ffffff; border-radius: 10px;
                      box-shadow: 0 4px 15px rgba(0,0,0,0.08); overflow: hidden; }
        .header     { background: #007bff; padding: 28px 30px; text-align: center; }
        .header h2  { color: #ffffff; margin: 0; font-size: 22px; }
        .body       { padding: 32px 36px; color: #333; }
        .body p     { line-height: 1.7; margin: 0 0 16px; }
        .btn        { display: inline-block; padding: 13px 34px; background: #007bff;
                      color: #ffffff !important; text-decoration: none; border-radius: 50px;
                      font-weight: bold; font-size: 15px; letter-spacing: 0.4px; }
        .note       { font-size: 12px; color: #888; margin-top: 24px; }
        .footer     { background: #f8f9fa; padding: 16px 30px; text-align: center;
                      font-size: 12px; color: #aaa; }
    </style>
</head>
<body>
<div class="wrapper">
    <div class="header">
        <h2>&#128272; Password Reset Request</h2>
    </div>
    <div class="body">
        <p>Hi <strong>' . htmlspecialchars($recipientName) . '</strong>,</p>
        <p>We received a request to reset the password for your employee account at AutoService.lk.
           Click the button below to choose a new password:</p>
        <p style="text-align:center; margin: 28px 0;">
            <a class="btn" href="' . htmlspecialchars($reset_url) . '">Reset My Password</a>
        </p>
        <p>This link will expire in <strong>1 hour</strong>. If you did not request a password reset,
           you can safely ignore this email — your account remains secure.</p>
        <p class="note">
            Button not working? Copy and paste this URL into your browser:<br>
            <a href="' . htmlspecialchars($reset_url) . '" style="color:#007bff; word-break:break-all;">'
            . htmlspecialchars($reset_url) . '</a>
        </p>
    </div>
    <div class="footer">
        &copy; ' . date('Y') . ' autoService.lk &mdash; All rights reserved.
    </div>
</div>
</body>
</html>';

try {
    $apiInstance->sendTransacEmail($mail);
    echo json_encode([
        'success' => true,
        'message' => 'A password reset link has been sent to ' . htmlspecialchars($email) . '. Please check your inbox (and spam folder).'
    ]);
} catch (Exception $e) {
    error_log('Brevo forgot-password error: ' . $e->getMessage());
    echo json_encode([
        'success' => false,
        'message' => 'Failed to send the reset email. Please try again later.'
    ]);
}