<?php

require_once __DIR__ . '/../../core/db.php';
session_start();

$db = Database::getInstance();

$email = trim($_POST['username']);
$password = $_POST['password'];


$user = $db->login($email);

if (!$user) {
    die('Utente non trovato');
}

if (!password_verify($password, $user['password'])) {
    die('Credenziali non valide');
}

$db->createSession($user['id']);
header('Location: ../public/index.php');
