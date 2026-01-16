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

        //GET /api/getUsers
        if ($resource === 'user' && $subroute === 'getUserInfo') {
            if ($userId === '') {
                Response::json([
                    'status' => 'error',
                    'message' => 'Unauthorized'
                ], 401);
                return;
            }
            $this->getUserInfo($userId);
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
            $this->getSpottedAccept();
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

        if ($resource === 'user' && $subroute === 'spottedOk') {
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                Response::json(['error' => 'Method Not Allowed'], 405);
                return;
            }
            if (!$db->checkAdmin($userId)) {
                Response::json(['error' => 'Unauthorized'], 401);
                return;
            }
            $data = json_decode(file_get_contents('php://input'), true);
            $spottedId = $data['spottedId'] ?? '';
            if ($spottedId === '') {
                Response::json([
                    'status' => 'error',
                    'message' => "Missing required 'spottedId' parameter"
                ], 400);
                return;
            }
            $this->validateSpotted($spottedId);
            Response::json(['status' => 'ok'], 200);
            return;
        }

        if ($resource === 'user' && $subroute === 'spottedReject') {
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                Response::json(['error' => 'Method Not Allowed'], 405);
                return;
            }
            if (!$db->checkAdmin($userId)) {
                Response::json(['error' => 'Unauthorized'], 401);
                return;
            }
            $data = json_decode(file_get_contents('php://input'), true);
            $spottedId = $data['spottedId'] ?? '';
            if ($spottedId === '') {
                Response::json([
                    'status' => 'error',
                    'message' => "Missing required 'spottedId' parameter"
                ], 400);
                return;
            }
            $this->rejectSpotted($spottedId);
            Response::json(['status' => 'ok'], 200);
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

    private function getUserInfo(string $userId): void{
        try{
            $db = Database::getInstance();
            $user = $db->getUserInformation($userId);

            Response::json([
                'status' => 'success',
                'data' => $user
            ]);
        } catch(Throwable $e) {
            Response::json([
                'status' => 'error',
                'message' => 'Failed to fetch spotted for user',
                'detail' => $e->getMessage()
            ], 500);
        }
    }

    private function spottedByUser(string $username): void {
        try {
            $db = Database::getInstance();
            $rows = $db->getSpottedUser($username);

            $spotted = array_map(fn($row) => [
                'id' => (int) $row['spotted_id'],
                'title' => $row['spotted_title'],
                'text' => $row['spotted_text'],
                'likes' => (int) $row['numLike'],
                'dislikes' => (int) $row['numDislike'],
                'status' => $row['status'],
                'createdAt' => $row['spotted_created_at'],
                'commentsCount' => (int) ($row['comments_count'] ?? 0),
                'category' => [
                    'id' => (int) $row['category_id'],
                    'name' => $row['category_name']
                ],
                'user' => [
                    'id' => (int) $row['user_id'],
                    'username' => $row['username'],
                    'name' => $row['user_name'],
                    'surname' => $row['surname']
                ]
            ], $rows);

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

    private function getSpottedAccept(): void {
        try {
            $db = Database::getInstance();
            $rows = $db->getSpottedAccept();

            $spotted = array_map(fn($row) => [
                'id' => (int) $row['spotted_id'],
                'title' => $row['spotted_title'],
                'text' => $row['spotted_text'],
                'likes' => (int) $row['numLike'],
                'dislikes' => (int) $row['numDislike'],
                'status' => $row['status'],
                'createdAt' => $row['spotted_created_at'],
                'commentsCount' => (int) ($row['comments_count'] ?? 0),
                'category' => [
                    'id' => (int) $row['category_id'],
                    'name' => $row['category_name']
                ],
                'user' => [
                    'id' => (int) $row['user_id'],
                    'username' => $row['username'],
                    'name' => $row['user_name'],
                    'surname' => $row['surname']
                ]
            ], $rows);

            Response::json([
                'status' => 'success',
                'data' => $spotted
            ]);
        } catch (Throwable $e) {
            Response::json([
                'status' => 'error',
                'message' => 'Failed to fetch spotted',
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

    private function rejectSpotted($spottedId)
    {
        try{
            $db = Database::getInstance();
            $spotted = $db->spottedReject($spottedId);

            Response::json([
                'status' => 'success',
                'spottedId'=> $spottedId,
                'data' => $spotted
            ]);
        } catch ( Throwable $e){
            Response::json([
                'status' => 'error',
                'message' => 'Failed to reject spotted for user',
                'detail' => $e->getMessage()
            ], 500);
        }
    }
}
