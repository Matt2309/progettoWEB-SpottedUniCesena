<?php
require_once __DIR__ . '/../core/db.php';
require_once __DIR__ . '/../core/response.php';

$uri = trim($_SERVER['REQUEST_URI'], '/');
$segments = explode('/', $uri);

if ($segments[0] !== 'api') {
    Response::json(['error' => 'Invalid API path'], 404);
}

$resource = $segments[1] ?? null;
switch ($resource) {
    // /api/user → controller -> UserController
    case 'user':
        require_once __DIR__ . '/controllers/UserController.php';
        $controller = new UserController();
        $controller->handle();
        break;

    default:
        Response::json(['error' => 'Resource not found'], 404);
}
