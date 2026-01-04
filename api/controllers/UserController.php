<?php

class UserController {

    public function handle() {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {

        $requestUri = $_SERVER['REQUEST_URI'] ?? '/';
        $path = parse_url($requestUri, PHP_URL_PATH) ?? '/';
        $segments = array_values(array_filter(explode('/', trim($path, '/'))));

        $apiIndex = array_search('api', $segments, true);
        $resource = $apiIndex !== false ? ($segments[$apiIndex + 1] ?? null) : null;
        $subroute = $apiIndex !== false ? ($segments[$apiIndex + 2] ?? null) : null;

        //GET /api/user
        if ($resource === 'user' && $subroute === null) {
            $this->testMessage();
            return;
        }

        //GET /api/user/getUserSpotted
        if ($resource === 'user' && $subroute === 'getUserSpotted') {
            $userId = $_GET['userId'] ?? '';
            if ($userId === '') {
                Response::json([
                    'status' => 'error',
                    'message' => "Missing required 'userId' parameter"
                ], 400);
            }
            $this->spottedByUser($userId);
            return;
        }

        //GET /api/user/getSpottedAccept
        if ($resource === 'user' && $subroute === 'getSpottedAccept') {
            $this->spottedAccept();
            return;
        }

        //GET /api/user/getUsers
        if ($resource === 'user' && $subroute === 'getUsers'){
            $this->usersList();
            return;
        }
    }

    Response::json(['error' => 'Not found'], 404);
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

    private function spottedAccept(): void {
        try{
            $db = new Database();
            $spotted = $db->getSpottedAccept();

            Response::json([
                'status' => 'success',
                'data' => $spotted
            ]);
        } catch (Throwable $e){
            Response::json([
                'status' => 'error',
                'message' => 'Failed to fetch spotted for user',
                'detail' => $e->getMessage()
            ], 500);
        }
    }

    private function usersList(): void {
        try{
            $db = new Database();
            $spotted = $db->getUsers();

            Response::json([
                'status' => 'success',
                'data' => $spotted
            ]);
        } catch ( Throwable $e){
            Response::json([
                'status' => 'error',
                'message' => 'Failed to fetch spotted for user',
                'detail' => $e->getMessage()
            ], 500);
        }
    }
}
