<?php
require_once __DIR__ . '/../core/db.php';
require_once __DIR__ . '/../core/response.php';

// Normalize URI and strip query string
$requestUri = $_SERVER['REQUEST_URI'] ?? '/';
$path = parse_url($requestUri, PHP_URL_PATH) ?? '/';
$segments = array_values(array_filter(explode('/', trim($path, '/'))));

// Find the index of the 'api' segment
$apiIndex = array_search('api', $segments, true);
if ($apiIndex === false) {
    Response::json(['error' => 'Invalid API path'], 404);
}

// Next segment after 'api' is the resource
$resource = $segments[$apiIndex + 1] ?? null;
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
