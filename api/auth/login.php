<?php

require_once __DIR__ . '/../../core/db.php';
session_start();

$db = new Database();

$email = trim($_POST['username']);
$password = $_POST['password'];


$user = $db->login($email);

if (!$user) {
    die('Utente non trovato');
}

if (!password_verify($password, $user['password'])) {
    die('Credenziali non valide');
}

session_regenerate_id(true);
$_SESSION['user_id'] = $user['id'];

header('Location: ../public/dashboard.php');
