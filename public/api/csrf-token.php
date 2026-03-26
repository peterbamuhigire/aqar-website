<?php
header('Content-Type: application/json');
header('Cache-Control: no-store');

$projectRoot = dirname(__DIR__, 2);
require_once $projectRoot . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable($projectRoot);
$dotenv->load();

if (empty($_ENV['CSRF_SECRET'])) {
    http_response_code(500);
    echo json_encode(['error' => 'CSRF secret not configured']);
    exit;
}

$timestamp = time();
$token = hash_hmac('sha256', (string) $timestamp, $_ENV['CSRF_SECRET']);

echo json_encode([
    'token' => $token,
    'ts' => $timestamp,
]);
