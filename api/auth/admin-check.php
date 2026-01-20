<?php
require_once __DIR__ . '/../../core/db.php';

$db = Database::getInstance();
$user = $db->getAuthenticatedUser();
$userId = $user['id'] ?? '';

if (!$db->checkAdmin($userId)) {
    header('Location: /public/index.html');
    exit;
}
