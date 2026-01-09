<?php

require_once __DIR__ . '/../../core/db.php';
session_start();

header("Content-Type: application/json");

$data = json_decode(file_get_contents("php://input"), true);
$email = trim($data['username'] ?? '');
$password = $data['password'] ?? '';

$errors = [];

if (!$email) {
    $errors["user"] = "Email obbligatoria";
}
if (!$password) {
    $errors["password"] = "Password obbligatoria";
}
if (!empty($errors)) {
    http_response_code(400);
    echo json_encode(["errors" => $errors]);
    exit;
}

$db = Database::getInstance();
$user = $db->login($email);

if (!$user) {
    http_response_code(401);
    echo json_encode([
        "errors" => ["user" => "Utente non trovato"]
    ]);
    exit;
}

if (!password_verify($password, $user['password'])) {
    http_response_code(401);
    echo json_encode([
        "errors" => ["password" => "Password errata"]
    ]);
    exit;
}

$db->createSession($user['id']);

echo json_encode(["success" => true]);
