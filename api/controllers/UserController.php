<?php

class UserController {

    public function handle() {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            // /api/user/getUserSpotted
            $requestUri = $_SERVER['REQUEST_URI'] ?? '/';
            $path = parse_url($requestUri, PHP_URL_PATH) ?? '/';
            $segments = array_values(array_filter(explode('/', trim($path, '/'))));

            $apiIndex = array_search('api', $segments, true);
            $resource = $apiIndex !== false ? ($segments[$apiIndex + 1] ?? null) : null;
            $subroute = $apiIndex !== false ? ($segments[$apiIndex + 2] ?? null) : null;

            if ($resource === 'user' && $subroute === 'getUserSpotted') {
                $userId = isset($_GET['userId']) ? trim((string)$_GET['userId']) : '';
                if ($userId === '') {
                    Response::json([
                        'status' => 'error',
                        'message' => "Missing required 'userId' parameter"
                    ], 400);
                }
                $this->spottedByUser($userId);
                return;
            }
        } else {
            Response::json(['error' => 'Method not allowed'], 405);
        }
    }

    private function testMessage() {
        Response::json([
            'status' => 'success',
            'message' => 'API is working'
        ]);
    }

    private function spottedByUser(string $username): void {
        try {
            $db = new Database();
            $spotted = $db->getSpottedUser($username);

            Response::json([
                'status' => 'success',
                'username' => $username,
                'data' => $spotted
            ]);
        } catch (Throwable $e) {
            Response::json([
                'status' => 'error',
                'message' => 'Failed to fetch spotted for user',
                'detail' => $e->getMessage()
            ], 500);
        }
    }
}
