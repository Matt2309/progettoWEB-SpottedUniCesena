<?php
require_once __DIR__ . '/../../core/db.php';

$db = Database::getInstance();
$user = $db->getAuthenticatedUser();

if (!$user) {
    header('Location: /public/Login.html');
    exit;
}
