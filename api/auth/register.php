<?php
require_once __DIR__ . '/../../core/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit;
}
$db = new Database();

$nome = trim($_POST['nome']);
$cognome = trim($_POST['cognome']);
$username = trim($_POST['username']);
$email = trim($_POST['email']);
$password = $_POST['password'];
$confirm = $_POST['confirm_password'];

if ($password !== $confirm) {
    http_response_code(400);
    die('Le password non coincidono');
}

$hash = password_hash($password, PASSWORD_DEFAULT);

try {
    $db->register($nome, $cognome, $email, $username, $hash);
    header('Location: /public/Login.html', true, 302);
    exit;
} catch (PDOException $e) {
    echo($e->getMessage());
    http_response_code(400);
    die('Email già registrata');
}
