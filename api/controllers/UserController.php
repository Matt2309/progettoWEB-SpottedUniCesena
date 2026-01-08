<?php
require_once __DIR__ . '/../../core/db.php';

class UserController {

    public function handle() {
        $db = Database::getInstance();
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {

        $requestUri = $_SERVER['REQUEST_URI'] ?? '/';
        $path = parse_url($requestUri, PHP_URL_PATH) ?? '/';
        $segments = array_values(array_filter(explode('/', trim($path, '/'))));

        $apiIndex = array_search('api', $segments, true);
        $resource = $apiIndex !== false ? ($segments[$apiIndex + 1] ?? null) : null;
        $subroute = $apiIndex !== false ? ($segments[$apiIndex + 2] ?? null) : null;
        $user = $db->getAuthenticatedUser();
        $userId = $user['id'] ?? '';

        //GET /api/user
        if ($resource === 'user' && $subroute === null) {
            $this->testMessage();
            return;
        }

        //GET /api/user/getUserSpotted
        if ($resource === 'user' && $subroute === 'getUserSpotted') {
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

        //GET /api/user/getCommentUser
        if ($resource === 'user' && $subroute === 'getCommentUser') {
            if ($userId === '') {
                Response::json([
                    'status' => 'error',
                    'message' => "Missing required 'userId' parameter"
                ], 400);
            }
            $this->commentUserList($userId);
            return;
        }

        //GET /api/user/getCommentSpotted
        if ($resource === 'user' && $subroute === 'getCommentSpotted') {
            $spottedId = $_GET['spottedId'] ?? '';
            if ($spottedId === '') {
                Response::json([
                    'status' => 'error',
                    'message' => "Missing required 'userId' parameter"
                ], 400);
            }
            $this->commentSpottedList($spottedId);
            return;
        }

        //GET /api/user/userBan
        if ($resource === 'user' && $subroute === 'userBan') {
            if (!$db->checkAdmin($userId)) {
                Response::json(['error' => 'Unauthorized'], 401);
                return;
            }
            if ($userId === '') {
                Response::json([
                    'status' => 'error',
                    'message' => "Missing required 'userId' parameter"
                ], 400);
            }
            $this->banUser($userId);
            return;
        }

        //GET /api/user/userSban
        if ($resource === 'user' && $subroute === 'userSban') {
            if (!$db->checkAdmin($userId)) {
                Response::json(['error' => 'Unauthorized'], 401);
                return;
            }
            if ($userId === '') {
                Response::json([
                    'status' => 'error',
                    'message' => "Missing required 'userId' parameter"
                ], 400);
            }
            $this->sbanUser($userId);
            return;
        }

        //GET /api/user/spottedOk
        if ($resource === 'user' && $subroute === 'spottedOk') {
            if (!$db->checkAdmin($userId)) {
                Response::json(['error' => 'Unauthorized'], 401);
                return;
            }
            $spottedId = $_GET['spottedId'] ?? '';
            if ($spottedId === '') {
                Response::json([
                    'status' => 'error',
                    'message' => "Missing required 'userId' parameter"
                ], 400);
            }
            $this->validateSpotted($spottedId);
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
            $db = Database::getInstance();
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
            $db = Database::getInstance();
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
            $db = Database::getInstance();
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

    private function commentUserList(string $userId): void {
        try{
            $db = Database::getInstance();
            $spotted = $db->getCommentUser($userId);

            Response::json([
                'status' => 'success',
                'userId'=> $userId,
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

    private function commentSpottedList(string $spottedId): void {
        try{
            $db = Database::getInstance();
            $spotted = $db->getCommentSpotted($spottedId);

            Response::json([
                'status' => 'success',
                'spottedId'=> $spottedId,
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

    private function banUser(string $userId): void {
        try{
            $db = Database::getInstance();
            $spotted = $db->userBan($userId);

            Response::json([
                'status' => 'success',
                'userId'=> $userId,
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

    private function sbanUser(string $userId): void {
        try{
            $db = Database::getInstance();
            $spotted = $db->userSban($userId);

            Response::json([
                'status' => 'success',
                'userId'=> $userId,
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

    private function validateSpotted(string $spottedId): void {
        try{
            $db = Database::getInstance();
            $spotted = $db->spottedOk($spottedId);

            Response::json([
                'status' => 'success',
                'spottedId'=> $spottedId,
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
