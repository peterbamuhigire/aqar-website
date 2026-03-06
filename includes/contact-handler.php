<?php
require_once __DIR__ . '/../config.php';

header('Content-Type: application/json');

// Only accept POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

// CSRF check
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$token = $_POST['csrf_token'] ?? '';
if (!isset($_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $token)) {
    http_response_code(403);
    echo json_encode(['success' => false, 'message' => 'Invalid request. Please refresh and try again.']);
    exit;
}

// Rate limiting (3 per 15 minutes per session)
$now = time();
$_SESSION['contact_attempts'] = $_SESSION['contact_attempts'] ?? [];
$_SESSION['contact_attempts'] = array_filter($_SESSION['contact_attempts'], fn($t) => ($now - $t) < 900);
if (count($_SESSION['contact_attempts']) >= 3) {
    http_response_code(429);
    echo json_encode(['success' => false, 'message' => 'Too many requests. Please try again later or use WhatsApp.']);
    exit;
}

// Validate
$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$message = trim($_POST['message'] ?? '');

$errors = [];
if (empty($name) || strlen($name) < 2) $errors[] = 'Name is required.';
if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Valid email is required.';
if (empty($message) || strlen($message) < 10) $errors[] = 'Message must be at least 10 characters.';

if (!empty($errors)) {
    http_response_code(422);
    echo json_encode(['success' => false, 'message' => implode(' ', $errors)]);
    exit;
}

// Sanitize
$name = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
$email = filter_var($email, FILTER_SANITIZE_EMAIL);
$phone = htmlspecialchars($phone, ENT_QUOTES, 'UTF-8');
$message = htmlspecialchars($message, ENT_QUOTES, 'UTF-8');

// Load mail config
$mailConfigFile = __DIR__ . '/../config/mail.php';
if (!file_exists($mailConfigFile)) {
    // If no mail config, log the contact and return success anyway
    $logFile = __DIR__ . '/../config/contact-log.txt';
    $logEntry = date('Y-m-d H:i:s') . " | Name: $name | Email: $email | Phone: $phone | Message: $message\n";
    file_put_contents($logFile, $logEntry, FILE_APPEND | LOCK_EX);

    $_SESSION['contact_attempts'][] = $now;
    echo json_encode(['success' => true, 'message' => 'Message received! We will get back to you shortly.']);
    exit;
}

// Send via PHPMailer
require_once __DIR__ . '/../vendor/autoload.php';
$mailConfig = require $mailConfigFile;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

try {
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = $mailConfig['host'];
    $mail->SMTPAuth = true;
    $mail->Username = $mailConfig['username'];
    $mail->Password = $mailConfig['password'];
    $mail->SMTPSecure = $mailConfig['encryption'];
    $mail->Port = $mailConfig['port'];

    $mail->setFrom($mailConfig['from_email'], $mailConfig['from_name']);
    $mail->addAddress($mailConfig['to_email']);
    $mail->addReplyTo($email, $name);

    $mail->isHTML(true);
    $mail->Subject = "Aqar Contact: $name";
    $mail->Body = "
        <h2>New Contact Form Submission</h2>
        <p><strong>Name:</strong> $name</p>
        <p><strong>Email:</strong> $email</p>
        <p><strong>Phone:</strong> " . ($phone ?: 'Not provided') . "</p>
        <hr>
        <p><strong>Message:</strong></p>
        <p>" . nl2br($message) . "</p>
    ";
    $mail->AltBody = "Name: $name\nEmail: $email\nPhone: " . ($phone ?: 'N/A') . "\n\nMessage:\n$message";

    $mail->send();
    $_SESSION['contact_attempts'][] = $now;
    echo json_encode(['success' => true, 'message' => 'Message sent! We will get back to you shortly.']);
} catch (Exception $e) {
    error_log("Mailer Error: " . $mail->ErrorInfo);
    echo json_encode(['success' => false, 'message' => 'Failed to send. Please try WhatsApp instead.']);
}
