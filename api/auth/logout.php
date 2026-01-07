<?php
require_once __DIR__ . '/../../core/db.php';
$db = Database::getInstance();

if (!empty($_COOKIE['SESSION_TOKEN'])) {
    $db->removeSession($_COOKIE['SESSION_TOKEN']);
}

setcookie('SESSION_TOKEN', '', time() - 3600, '/');
header('Location: /public/login.html');
