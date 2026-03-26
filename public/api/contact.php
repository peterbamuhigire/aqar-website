<?php
header('Content-Type: application/json');
header('Cache-Control: no-store');

// ── Bootstrap ──────────────────────────────────────────────
$projectRoot = dirname(__DIR__, 2);
require_once $projectRoot . '/vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$dotenv = Dotenv\Dotenv::createImmutable($projectRoot);
$dotenv->load();

// ── Bilingual messages ─────────────────────────────────────
$messages = [
    'en' => [
        'success' => 'Thank you! Your message has been sent. We shall get back to you within 24 hours.',
        'invalid_input' => 'Please check your input and try again.',
        'rate_limit' => 'Too many messages. Please try again later.',
        'csrf_fail' => 'Security validation failed. Please reload the page and try again.',
        'method' => 'Method not allowed.',
        'server_error' => 'Something went wrong. Please try again or contact us via WhatsApp.',
    ],
    'fr' => [
        'success' => 'Merci ! Votre message a été envoyé. Nous vous répondrons dans les 24 heures.',
        'invalid_input' => 'Veuillez vérifier vos informations et réessayer.',
        'rate_limit' => 'Trop de messages. Veuillez réessayer plus tard.',
        'csrf_fail' => 'Échec de la validation de sécurité. Veuillez recharger la page et réessayer.',
        'method' => 'Méthode non autorisée.',
        'server_error' => 'Une erreur est survenue. Veuillez réessayer ou nous contacter via WhatsApp.',
    ],
];

// ── Helpers ────────────────────────────────────────────────
$h = fn(string $str): string => htmlspecialchars($str, ENT_QUOTES | ENT_HTML5, 'UTF-8');

function jsonResponse(int $code, bool $success, string $message, array $extra = []): void {
    http_response_code($code);
    echo json_encode(array_merge(['success' => $success, 'message' => $message], $extra));
    exit;
}

// Silent reject — fake 200 so bots can't adapt
function silentReject(string $lang, array $messages): void {
    jsonResponse(200, true, $messages[$lang]['success']);
}

// ── 1. Method check ────────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Allow: POST, OPTIONS');
    jsonResponse(405, false, $messages['en']['method']);
}

// ── 2. Parse JSON body ─────────────────────────────────────
$raw = file_get_contents('php://input');
$data = json_decode($raw, true);

if (!is_array($data)) {
    jsonResponse(400, false, 'Invalid request body.');
}

$lang = isset($data['lang']) && in_array($data['lang'], ['en', 'fr']) ? $data['lang'] : 'en';
$msg = $messages[$lang];

// ── 3. Honeypot check ──────────────────────────────────────
if (!empty($data['website'])) {
    silentReject($lang, $messages);
}

// ── 4. Timing check (>3s since page load) ──────────────────
if (isset($data['_loaded_at'])) {
    $elapsed = time() - (int) $data['_loaded_at'];
    if ($elapsed < 3) {
        silentReject($lang, $messages);
    }
}

// ── 5. CSRF validation ────────────────────────────────────
$csrfToken = $data['_csrf_token'] ?? '';
$csrfTs = (int) ($data['_csrf_ts'] ?? 0);

if (empty($_ENV['CSRF_SECRET'])) {
    jsonResponse(500, false, 'Server configuration error.');
}

$expectedToken = hash_hmac('sha256', (string) $csrfTs, $_ENV['CSRF_SECRET']);
if (!hash_equals($expectedToken, $csrfToken)) {
    jsonResponse(403, false, $msg['csrf_fail']);
}

// Token expires after 1 hour
if (abs(time() - $csrfTs) > 3600) {
    jsonResponse(403, false, $msg['csrf_fail']);
}

// ── 6. Rate limiting ──────────────────────────────────────
$dataDir = $projectRoot . '/data';
if (!is_dir($dataDir)) {
    mkdir($dataDir, 0755, true);
}

$rateLimitFile = $dataDir . '/rate_limits.json';
$maxAttempts = (int) ($_ENV['RATE_LIMIT_MAX'] ?? 5);
$window = (int) ($_ENV['RATE_LIMIT_WINDOW'] ?? 3600);

$ipHash = hash('sha256', $_SERVER['REMOTE_ADDR'] ?? 'unknown');
$rateLimits = [];

if (file_exists($rateLimitFile)) {
    $rateLimits = json_decode(file_get_contents($rateLimitFile), true) ?: [];
}

// Clean expired entries
$now = time();
foreach ($rateLimits as $ip => $timestamps) {
    $rateLimits[$ip] = array_filter($timestamps, fn($ts) => ($now - $ts) < $window);
    if (empty($rateLimits[$ip])) {
        unset($rateLimits[$ip]);
    }
}

$attempts = $rateLimits[$ipHash] ?? [];
if (count($attempts) >= $maxAttempts) {
    jsonResponse(429, false, $msg['rate_limit']);
}

$rateLimits[$ipHash][] = $now;
file_put_contents($rateLimitFile, json_encode($rateLimits), LOCK_EX);

// ── 7. Input validation ───────────────────────────────────
$errors = [];

$name = trim($data['name'] ?? '');
$email = trim($data['email'] ?? '');
$phone = trim($data['phone'] ?? '');
$message = trim($data['message'] ?? '');

if (strlen($name) < 2 || strlen($name) > 200) {
    $errors[] = $lang === 'en' ? 'Name must be between 2 and 200 characters.' : 'Le nom doit contenir entre 2 et 200 caractères.';
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = $lang === 'en' ? 'Please enter a valid email address.' : 'Veuillez saisir une adresse e-mail valide.';
}

if ($phone !== '' && !preg_match('/^[\+\d\s\-\(\)]{7,20}$/', $phone)) {
    $errors[] = $lang === 'en' ? 'Please enter a valid phone number.' : 'Veuillez saisir un numéro de téléphone valide.';
}

if (strlen($message) < 10 || strlen($message) > 5000) {
    $errors[] = $lang === 'en' ? 'Message must be between 10 and 5000 characters.' : 'Le message doit contenir entre 10 et 5000 caractères.';
}

if (!empty($errors)) {
    jsonResponse(422, false, $msg['invalid_input'], ['errors' => $errors]);
}

// ── 8. Spam content scan ──────────────────────────────────
$spamPatterns = [
    '/\b(viagra|cialis|casino|lottery|crypto|bitcoin|nft|forex)\b/i',
    '/(https?:\/\/\S+\s*){3,}/i',  // 3+ URLs
    '/<script|<iframe|javascript:/i',
    '/[\x00-\x08\x0B\x0C\x0E-\x1F]/',  // Control characters
];

foreach ($spamPatterns as $pattern) {
    if (preg_match($pattern, $message) || preg_match($pattern, $name)) {
        silentReject($lang, $messages);
    }
}

// ── 9. Send emails via PHPMailer ──────────────────────────
try {
    // --- Admin notification ---
    $adminMail = new PHPMailer(true);
    $adminMail->isSMTP();
    $adminMail->Host = $_ENV['SMTP_HOST'];
    $adminMail->SMTPAuth = true;
    $adminMail->Username = $_ENV['SMTP_USERNAME'];
    $adminMail->Password = $_ENV['SMTP_PASSWORD'];
    $adminMail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $adminMail->Port = (int) $_ENV['SMTP_PORT'];
    $adminMail->CharSet = 'UTF-8';

    $adminMail->setFrom($_ENV['SMTP_FROM_EMAIL'], $_ENV['SMTP_FROM_NAME']);
    $adminMail->addAddress($_ENV['SMTP_RECIPIENT']);
    $adminMail->addReplyTo($email, $name);

    $adminMail->isHTML(true);
    $adminMail->Subject = 'New Enquiry from ' . $h($name) . ' — AQAR Website';

    $phoneDisplay = $phone ?: 'N/A';
    $timestamp = date('Y-m-d H:i:s T');
    $ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';

    $adminMail->Body = <<<HTML
    <!DOCTYPE html>
    <html>
    <head><meta charset="UTF-8"></head>
    <body style="margin:0;padding:0;font-family:'Source Sans 3',Helvetica,Arial,sans-serif;background:#f5f5f5;">
      <div style="max-width:600px;margin:0 auto;background:#ffffff;">
        <!-- Header -->
        <div style="background:linear-gradient(135deg,#0d7377,#0a5c5f);padding:32px 24px;text-align:center;">
          <h1 style="color:#ffffff;margin:0;font-size:24px;font-weight:700;">New Contact Enquiry</h1>
          <p style="color:#b3e2e3;margin:8px 0 0;font-size:14px;">AQAR Property Management Website</p>
        </div>
        <!-- Quick summary -->
        <div style="background:#e6f5f5;padding:16px 24px;border-bottom:1px solid #b3e2e3;">
          <p style="margin:0;font-size:14px;color:#0a5c5f;"><strong>{$h($name)}</strong> &middot; <a href="mailto:{$h($email)}" style="color:#0d7377;">{$h($email)}</a></p>
        </div>
        <!-- Data table -->
        <div style="padding:24px;">
          <table style="width:100%;border-collapse:collapse;font-size:14px;">
            <tr><td style="padding:10px 12px;font-weight:600;color:#454542;border-bottom:1px solid #e0e0dd;width:120px;">Name</td><td style="padding:10px 12px;color:#2e2e2c;border-bottom:1px solid #e0e0dd;">{$h($name)}</td></tr>
            <tr><td style="padding:10px 12px;font-weight:600;color:#454542;border-bottom:1px solid #e0e0dd;">Email</td><td style="padding:10px 12px;color:#2e2e2c;border-bottom:1px solid #e0e0dd;"><a href="mailto:{$h($email)}" style="color:#0d7377;">{$h($email)}</a></td></tr>
            <tr><td style="padding:10px 12px;font-weight:600;color:#454542;border-bottom:1px solid #e0e0dd;">Phone</td><td style="padding:10px 12px;color:#2e2e2c;border-bottom:1px solid #e0e0dd;">{$h($phoneDisplay)}</td></tr>
            <tr><td style="padding:10px 12px;font-weight:600;color:#454542;border-bottom:1px solid #e0e0dd;">Language</td><td style="padding:10px 12px;color:#2e2e2c;border-bottom:1px solid #e0e0dd;">{$h(strtoupper($lang))}</td></tr>
          </table>
          <!-- Message -->
          <div style="margin-top:20px;padding:16px;background:#fafaf7;border-left:4px solid #0d7377;border-radius:4px;">
            <p style="margin:0 0 4px;font-size:12px;font-weight:600;color:#787873;text-transform:uppercase;">Message</p>
            <p style="margin:0;color:#2e2e2c;line-height:1.6;white-space:pre-wrap;">{$h($message)}</p>
          </div>
        </div>
        <!-- Footer -->
        <div style="background:#f5f5f5;padding:16px 24px;font-size:11px;color:#a0a09b;text-align:center;">
          IP: {$h($ip)} &middot; {$h($timestamp)} &middot; Lang: {$h($lang)}
        </div>
      </div>
    </body>
    </html>
    HTML;

    $adminMail->AltBody = "New enquiry from {$name} ({$email})\nPhone: {$phoneDisplay}\n\nMessage:\n{$message}";
    $adminMail->send();

    // --- User confirmation ---
    $userMail = new PHPMailer(true);
    $userMail->isSMTP();
    $userMail->Host = $_ENV['SMTP_HOST'];
    $userMail->SMTPAuth = true;
    $userMail->Username = $_ENV['SMTP_USERNAME'];
    $userMail->Password = $_ENV['SMTP_PASSWORD'];
    $userMail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $userMail->Port = (int) $_ENV['SMTP_PORT'];
    $userMail->CharSet = 'UTF-8';

    $userMail->setFrom($_ENV['SMTP_FROM_EMAIL'], $_ENV['SMTP_FROM_NAME']);
    $userMail->addAddress($email, $name);

    $userMail->isHTML(true);

    if ($lang === 'fr') {
        $userMail->Subject = 'Merci pour votre message — AQAR';
        $greeting = "Bonjour {$h($name)},";
        $thankYou = 'Nous avons bien reçu votre message et nous vous répondrons dans les 24 heures.';
        $teamSign = "L'équipe AQAR";
        $noReply = 'Ce message a été envoyé automatiquement. Veuillez ne pas y répondre directement.';
    } else {
        $userMail->Subject = 'Thank you for your message — AQAR';
        $greeting = "Dear {$h($name)},";
        $thankYou = 'We have received your message and shall get back to you within 24 hours.';
        $teamSign = 'The AQAR Team';
        $noReply = 'This is an automated message. Please do not reply directly to this email.';
    }

    $userMail->Body = <<<HTML
    <!DOCTYPE html>
    <html>
    <head><meta charset="UTF-8"></head>
    <body style="margin:0;padding:0;font-family:'Source Sans 3',Helvetica,Arial,sans-serif;background:#f5f5f5;">
      <div style="max-width:600px;margin:0 auto;background:#ffffff;">
        <!-- Header -->
        <div style="background:linear-gradient(135deg,#0d7377,#0a5c5f);padding:32px 24px;text-align:center;">
          <h1 style="color:#ffffff;margin:0;font-size:28px;font-weight:800;letter-spacing:-0.5px;"><span style="color:#e8913a;">A</span>QAR</h1>
          <p style="color:#b3e2e3;margin:8px 0 0;font-size:13px;">Property Management Software</p>
        </div>
        <!-- Body -->
        <div style="padding:32px 24px;">
          <p style="font-size:16px;color:#1A1F2E;margin:0 0 16px;line-height:1.6;">{$greeting}</p>
          <p style="font-size:16px;color:#454542;margin:0 0 24px;line-height:1.6;">{$thankYou}</p>
          <!-- CTA -->
          <div style="text-align:center;margin:32px 0;">
            <a href="https://aqarproperty.co.uk" style="display:inline-block;background:#0d7377;color:#ffffff;padding:14px 32px;border-radius:8px;text-decoration:none;font-weight:700;font-size:14px;">Visit AQAR</a>
          </div>
          <p style="font-size:14px;color:#787873;margin:24px 0 0;line-height:1.5;">— {$teamSign}</p>
        </div>
        <!-- Footer -->
        <div style="border-top:1px solid #e0e0dd;padding:16px 24px;text-align:center;">
          <p style="margin:0;font-size:11px;color:#a0a09b;">{$noReply}</p>
          <p style="margin:8px 0 0;font-size:11px;color:#a0a09b;">AQAR Property Management &middot; Bukoto, Kampala, Uganda</p>
        </div>
      </div>
    </body>
    </html>
    HTML;

    $userMail->AltBody = "{$greeting}\n\n{$thankYou}\n\n— {$teamSign}";
    $userMail->send();

    jsonResponse(200, true, $msg['success']);

} catch (Exception $e) {
    error_log('AQAR Contact Form Error: ' . $e->getMessage());
    jsonResponse(500, false, $msg['server_error']);
}
