<?php
require_once __DIR__ . '/../../core/db.php';

class UserController {

    public function handle() {
        $db = Database::getInstance();
        if ($_SERVER['REQUEST_METHOD'] === 'GET' || $_SERVER['REQUEST_METHOD'] === 'POST') {

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

        //GET /api/user/getAllSpotted
        if ($resource === 'user' && $subroute === 'getAllSpotted') {
            $this->getSpotteds();
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
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                Response::json(['error' => 'Method Not Allowed'], 405);
                return;
            }
            if (!$db->checkAdmin($userId)) {
                Response::json(['error' => 'Unauthorized'], 401);
                return;
            }
            $data = json_decode(file_get_contents('php://input'), true);
            $userToBan = $data['userId'] ?? '';
            if ($userToBan === '') {
                Response::json([
                    'status' => 'error',
                    'message' => "Missing required 'userId' parameter"
                ], 400);
                return;
            }
            $this->banUser($userToBan);
            Response::json(['status' => 'ok'], 200);
            return;
        }

        //GET /api/user/userSban
        if ($resource === 'user' && $subroute === 'userSban') {
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                Response::json(['error' => 'Method Not Allowed'], 405);
                return;
            }
            if (!$db->checkAdmin($userId)) {
                Response::json(['error' => 'Unauthorized'], 401);
                return;
            }
            $data = json_decode(file_get_contents('php://input'), true);
            $userToBan = $data['userId'] ?? '';
            if ($userToBan === '') {
                Response::json([
                    'status' => 'error',
                    'message' => "Missing required 'userId' parameter"
                ], 400);
                return;
            }
            $this->sbanUser($userToBan);
            Response::json(['status' => 'ok'], 200);
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

        if ($resource === 'user' && $subroute === 'createSpotted') {

            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                Response::json(['error' => 'Method Not Allowed'], 405);
                return;
            }

            if ($userId === '') {
                Response::json(['error' => 'Unauthorized'], 401);
                return;
            }

            $data = json_decode(file_get_contents('php://input'), true);

            $text = $data['text'] ?? '';
            $categoryId = $data['category_id'] ?? '';

            if ($text === '' || $categoryId === '') {
                Response::json([
                    'status' => 'error',
                    'message' => 'Missing required parameters'
                ], 400);
                return;
            }

            if ($user["isBanned"]) {
                Response::json([
                    'status' => 'error',
                    'message' => 'Non puoi postare in quanto sei stato bannato'
                ], 401);
                return;
            }

            $this->createSpotted($text, $userId, $categoryId);
            return;
        }

        if ($resource === 'user' && $subroute === 'likeSpotted') {

            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                Response::json(['error' => 'Method Not Allowed'], 405);
                return;
            }

            if ($userId === '') {
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

            $this->likeSpotted($spottedId, $userId);
            return;
        }

        if ($resource === 'user' && $subroute === 'getLikedSpotted') {
            if ($userId === '') {
                Response::json([
                    'status' => 'error',
                    'message' => "Missing required 'userId' parameter"
                ], 400);
            }
            $this->likedSpottedList($userId);
            return;
        }

        if ($resource === 'user' && $subroute === 'dislikeSpotted') {

            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                Response::json(['error' => 'Method Not Allowed'], 405);
                return;
            }

            if ($userId === '') {
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

            $this->dislikeSpotted($spottedId);
            return;
        }

        if ($resource === 'user' && $subroute === 'createComment') {

            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                Response::json(['error' => 'Method Not Allowed'], 405);
                return;
            }

            if ($userId === '') {
                Response::json(['error' => 'Unauthorized'], 401);
                return;
            }

            $data = json_decode(file_get_contents('php://input'), true);

            $text = $data['text'] ?? '';
            $spottedId = $data['spottedId'] ?? '';

            if ($text === '' || $spottedId === '') {
                Response::json([
                    'status' => 'error',
                    'message' => 'Missing required parameters'
                ], 400);
                return;
            }

            $this->createComment($text, $userId, $spottedId);
            return;
        }

        if ($resource === 'user' && $subroute === 'getCategories') {
            $this->getCategories();
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

    private function getSpotteds(): void {
        try {
            $db = Database::getInstance();
            $rows = $db->getSpotteds();

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
                    'surname' => $row['surname'],
                    'isBanned' => $row['isBanned']
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
            $rows =$db->getCommentUser($userId);

            $comments = array_map(fn($row) => [
                'id' => (int) $row['comment_id'],
                'text' => $row['text'],
                'created_at' => $row['created_at'],
                'user' => [
                    'id' => (int) $row['user_id'],
                    'username' => $row['username']
                ]
            ], $rows);

            Response::json([
                'status' => 'success',
                'userId'=> $userId,
                'data' => $comments
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
            $rows = $db->getCommentSpotted($spottedId);

            $comments = array_map(fn($row) => [
                'id' => (int) $row['comment_id'],
                'text' => $row['text'],
                'created_at' => $row['created_at'],
                'user' => [
                    'id' => (int) $row['user_id'],
                    'username' => $row['username']
                ]
            ], $rows);

            Response::json([
                'status' => 'success',
                'spottedId'=> $spottedId,
                'data' => $comments
            ]);
        } catch ( Throwable $e){
            Response::json([
                'status' => 'error',
                'message' => 'Failed to fetch spotted for user',
                'detail' => $e->getMessage()
            ], 500);
        }
    }

    private function likedSpottedList(string $userId): void {
        try{
            $db = Database::getInstance();
            $rows = $db->getLikedSpottedByUser($userId);

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
                'userId'=> $userId,
                'data' => $spotted
            ]);
        } catch ( Throwable $e){
            Response::json([
                'status' => 'error',
                'message' => 'Failed to fetch liked spotted for user',
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

    private function createSpotted(string $text, string $userId, string $categoryId): void {
        try {
            $db = Database::getInstance();
            $db->createSpotted($text, $userId, $categoryId);

            Response::json([
                'status' => 'success',
                'message' => 'Spotted created successfully'
            ], 201);

        } catch (Throwable $e) {
            Response::json([
                'status' => 'error',
                'message' => 'Failed to create spotted',
                'detail' => $e->getMessage()
            ], 500);
        }
    }

    private function likeSpotted(string $spottedId, string $userId): void {
        try {
            $db = Database::getInstance();
            $db->likeSpotted($spottedId, $userId);

            Response::json([
                'status' => 'success',
                'spottedId' => $spottedId
            ], 200);

        } catch (Throwable $e) {
            Response::json([
                'status' => 'error',
                'message' => 'Failed to like spotted',
                'detail' => $e->getMessage()
            ], 500);
        }
    }

    private function dislikeSpotted(string $spottedId): void {
        try {
            $db = Database::getInstance();
            $db->dislikeSpotted($spottedId);

            Response::json([
                'status' => 'success',
                'spottedId' => $spottedId
            ], 200);

        } catch (Throwable $e) {
            Response::json([
                'status' => 'error',
                'message' => 'Failed to dislike spotted',
                'detail' => $e->getMessage()
            ], 500);
        }
    }

    private function createComment(string $text, string $userId, string $spottedId): void {
        try {
            $db = Database::getInstance();
            $db->createComment($text, $userId, $spottedId);

            Response::json([
                'status' => 'success',
                'message' => 'Comment created successfully'
            ], 201);

        } catch (Throwable $e) {
            Response::json([
                'status' => 'error',
                'message' => 'Failed to create comment',
                'detail' => $e->getMessage()
            ], 500);
        }
    }

    private function getCategories(): void {
        try {
            $db = Database::getInstance();
            $categories = $db->getCategories();

            Response::json([
                'status' => 'success',
                'data' => $categories
            ]);
        } catch (Throwable $e) {
            Response::json([
                'status' => 'error',
                'message' => 'Failed to fetch categories',
                'detail' => $e->getMessage()
            ], 500);
        }
    }
}
