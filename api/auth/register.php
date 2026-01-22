<?php
require_once __DIR__ . '/../../core/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit;
}
header("Content-Type: application/json");

$db = Database::getInstance();

$data = json_decode(file_get_contents("php://input"), true);
$nome = trim($data['nome']);
$cognome = trim($data['cognome']);
$username = trim($data['username']);
$email = trim($data['email']);
$password = $data['password'];
$confirm = $data['confirm_password'];

if ($password !== $confirm) {
    http_response_code(400);
    echo json_encode([
        "errors" => ["cfPassword" => "Le password non coincidono"]
    ]);
    exit;
}

$hash = password_hash($password, PASSWORD_DEFAULT);

try {
    $db->register($nome, $cognome, $email, $username, $hash);
    echo json_encode(["success" => true]);
    exit;
} catch (PDOException $e) {
    http_response_code(400);
    echo json_encode([
        "errors" => ["form" => "Email già registrata"]
    ]);
    exit;
}
