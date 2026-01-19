<?php

class Database {
    private static ?PDO $instance = null;
    private static ?Database $dbInstance = null;
    private PDO $db;

    private function __construct()
    {
        $this->db = self::getConnection();
    }

    // istanza singleton per non creare n istanze diverse
    public static function getInstance(): Database {
        if (!self::$dbInstance) {
            self::$dbInstance = new Database();
        }
        return self::$dbInstance;
    }

    public static function getConnection(): PDO {
        if (!self::$instance) {
            $config = require __DIR__ . '/../config/config.php';

            try {
                $host = $config['db']['host'];
                $port = $config['db']['port'] ?? 3306;
                $charset = $config['db']['charset'] ?? 'utf8mb4';

                $dsn = "mysql:host={$host};port={$port};charset={$charset}";
                $pdo = new PDO(
                    $dsn,
                    $config['db']['user'],
                    $config['db']['pass'],
                    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
                );

                // create DB if not exist
                $pdo->exec("CREATE DATABASE IF NOT EXISTS `{$config['db']['name']}`");
                $pdo->exec("USE `{$config['db']['name']}`");

                // create tables
                $sqlFile = __DIR__ . '/../database.sql';
                if (file_exists($sqlFile)) {
                    $pdo->exec(file_get_contents($sqlFile));
                }

                self::$instance = $pdo;

            } catch (PDOException $e) {
                http_response_code(500);
                die(json_encode([
                    'status' => 'error',
                    'message' => 'DB connection error: ' . $e->getMessage()
                ]));
            }
        }

        return self::$instance;
    }

    //Lista Spotted accettati
    public function getSpottedAccept(): array {
        $query = "
        SELECT
            s.id            AS spotted_id,
            s.title         AS spotted_title,
            s.text          AS spotted_text,
            s.numLike,
            s.numDislike,
            s.status,
            s.created_at    AS spotted_created_at,

            c.id            AS category_id,
            c.name          AS category_name,

            u.id            AS user_id,
            u.username,
            u.name          AS user_name,
            u.surname,
        
            COUNT(co.id)    AS comments_count
        FROM spotted s
        JOIN categories c ON s.category_id = c.id
        JOIN users u ON s.user_id = u.id
        LEFT JOIN comments co ON co.spotted_id = s.id
        WHERE s.status = :status
        GROUP BY
            s.id,
            c.id,
            u.id
        ORDER BY s.created_at DESC
    ";

        $stmt = $this->db->prepare($query);
        $stmt->execute([
            ':status' => 'APPROVED'
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    //lista spotted per utente
    public function getSpottedUser($userId) {
        $query = "
        SELECT
            s.id            AS spotted_id,
            s.title         AS spotted_title,
            s.text          AS spotted_text,
            s.numLike,
            s.numDislike,
            s.status,
            s.created_at    AS spotted_created_at,

            c.id            AS category_id,
            c.name          AS category_name,

            u.id            AS user_id,
            u.username,
            u.name          AS user_name,
            u.surname,
        
            COUNT(co.id)    AS comments_count
        FROM spotted s
        JOIN categories c ON s.category_id = c.id
        JOIN users u ON s.user_id = u.id
        LEFT JOIN comments co ON co.spotted_id = s.id
        WHERE s.user_id = :userId
        GROUP BY
            s.id,
            c.id,
            u.id
        ORDER BY s.created_at DESC
    ";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    //lista utenti
    public function getUsers(){
        $query = "SELECT username FROM users";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //lista commenti per un certo utente
    public function getCommentUser($userId){
        $query = "SELECT 
                    c.id as comment_id, 
                    c.text, 
                    c.created_at, 
                    c.user_id, 
                    u.username 
                    FROM comments c 
                        JOIN users u ON c.user_id = u.id 
                    WHERE c.user_id = :userId
                    ORDER BY c.created_at DESC";
        $stmt = $this->db->prepare($query);
        $stmt->execute([':userId' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //lista commenti spotted
    public function getCommentSpotted($spottedId){
        $query = "SELECT 
                    c.id as comment_id, 
                    c.text, 
                    c.created_at, 
                    c.user_id, 
                    u.username 
                    FROM comments c 
                        JOIN users u ON c.user_id = u.id 
                    WHERE c.spotted_id = :spottedId 
                    ORDER BY c.created_at DESC";
        $stmt = $this->db->prepare($query);
        $stmt->execute([':spottedId' => $spottedId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //lista spotted liked da un utente
    public function getLikedSpottedByUser($userId){
        $query = "SELECT
                    s.id            AS spotted_id,
                    s.title         AS spotted_title,
                    s.text          AS spotted_text,
                    s.numLike,
                    s.numDislike,
                    s.status,
                    s.created_at    AS spotted_created_at,

                    c.id            AS category_id,
                    c.name          AS category_name,

                    u.id            AS user_id,
                    u.username,
                    u.name          AS user_name,
                    u.surname,
                
                    COUNT(co.id)    AS comments_count
                FROM spotted s
                JOIN categories c ON s.category_id = c.id
                JOIN users u ON s.user_id = u.id
                LEFT JOIN comments co ON co.spotted_id = s.id
                WHERE s.numLike > 0 AND s.id IN (
                    SELECT spotted_id FROM spotted_likes WHERE user_id = :userId
                )
                GROUP BY
                    s.id,
                    c.id,
                    u.id
                ORDER BY s.created_at DESC";
        $stmt = $this->db->prepare($query);
        $stmt->execute([':userId' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //bannare utente
    public function userBan($userId){
        $query = "UPDATE users SET isBanned=1 WHERE id = :userId";
        $stmt = $this->db->prepare($query);
        $stmt->execute(['userId' => $userId]);
        return $stmt->execute();
    }

    //sbannare utente
    public function userSban($userId){
        $query = "UPDATE users SET isBanned=0 WHERE id = :userId";
        $stmt = $this->db->prepare($query);
        $stmt->execute(['userId' => $userId]);
        return $stmt->execute();
    }

    //accettazione spotted
    public function spottedOk($spottedId){
        $query = "UPDATE spotted SET status='APPROVED' WHERE id = :spottedId";
        $stmt = $this->db->prepare($query);
        $stmt->execute([':spottedId' => $spottedId]);
        return $stmt->execute();
    }

    // reject spotted
    public function spottedReject($spottedId){
        $query = "UPDATE spotted SET status='REJECTED' WHERE id = :spottedId";
        $stmt = $this->db->prepare($query);
        $stmt->execute([':spottedId' => $spottedId]);
        return $stmt->execute();
    }

    //Post Spotted
    public function createSpotted($title, $text, $userId, $categoryId){
        $query = "INSERT INTO spotted 
              (title, text, numLike, numDislike, user_id, category_id, status, created_at)
              VALUES 
              (:title, :text, 0, 0, :user_id, :category_id, 'PENDING', NOW())";

        $stmt = $this->db->prepare($query);

        return $stmt->execute([
            ':title' => $title,
            ':text' => $text,
            ':user_id' => $userId,
            ':category_id' => $categoryId
        ]);
    }

    //like spotted
    public function likeSpotted(string $spottedId, string $userId = null): bool {
        $query = "UPDATE spotted 
              SET numLike = numLike + 1 
              WHERE id = :spottedId";

        $stmt = $this->db->prepare($query);
        $result = $stmt->execute([
            ':spottedId' => $spottedId
        ]);

        // Insert into spotted_likes table if userId is provided
        if ($userId !== null && $result) {
            try {
                $likeQuery = "INSERT INTO spotted_likes (user_id, spotted_id) 
                             VALUES (:user_id, :spotted_id)
                             ON DUPLICATE KEY UPDATE created_at = NOW()";
                $likeStmt = $this->db->prepare($likeQuery);
                $likeStmt->execute([
                    ':user_id' => $userId,
                    ':spotted_id' => $spottedId
                ]);
            } catch (PDOException $e) {
                // Silently fail if like already exists
            }
        }

        return $result;
    }

    public function dislikeSpotted(string $spottedId): bool {
        $query = "UPDATE spotted 
              SET numDislike = numDislike + 1 
              WHERE id = :spottedId";

        $stmt = $this->db->prepare($query);
        return $stmt->execute([
            ':spottedId' => $spottedId
        ]);
    }

    public function createComment(string $text, string $userId, string $spottedId): bool {
        $query = "INSERT INTO comments (text, user_id, spotted_id, created_at)
              VALUES (:text, :user_id, :spotted_id, NOW())";

        $stmt = $this->db->prepare($query);
        return $stmt->execute([
            ':text' => $text,
            ':user_id' => $userId,
            ':spotted_id' => $spottedId
        ]);
    }

    public function getCategories(): array {
        $query = "SELECT id, name FROM categories";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //Controllo utente admin
    public function checkAdmin($userId){
        $query = "SELECT (r.title = 'admin') AS isAdmin
        FROM users u
        JOIN roles r ON r.id = u.role_id
        WHERE u.id = :userId
        LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->execute([
            ':userId' => $userId
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    //registrazione
    public function register($nome, $cognome, $email, $username, $hash){
        $query = "
        INSERT INTO users (name, surname, email, username, password, role_id)
        VALUES (
            :n,
            :c,
            :e,
            :u,
            :p,
            (SELECT id FROM roles WHERE title = 'USER')
        )
        ";

        $stmt = $this->db->prepare($query);
        $stmt->execute([
            'n' => $nome,
            'c' => $cognome,
            'e' => $email,
            'u' => $username,
            'p' => $hash
        ]);

        return $stmt->rowCount() > 0;
    }

    //login
    public function login($email){
        $query = "SELECT id, password FROM users WHERE email = :e OR username = :e";

        $stmt = $this->db->prepare($query);
        $stmt->execute(['e' => $email]);
        return $stmt->fetch();
    }

    public function createSession(int $userId) {
        $rawToken = bin2hex(random_bytes(32));
        $tokenHash = hash('sha256', $rawToken);

        $expires = (new DateTime('+7 days'))->format('Y-m-d H:i:s');

        $stmt = $this->db->prepare("
        REPLACE INTO sessions (user_id, token, expiredIn)
        VALUES (:uid, :token, :exp)
    ");

        $stmt->execute([
            'uid' => $userId,
            'token' => $tokenHash,
            'exp' => $expires
        ]);

        setcookie(
            'SESSION_TOKEN',
            $rawToken,
            [
                'expires'  => strtotime($expires),
                'path'     => '/',
                'secure'   => false,
                'httponly' => false,
                'samesite' => 'Strict'
            ]
        );
    }


    function getAuthenticatedUser() {
        if (empty($_COOKIE['SESSION_TOKEN'])) {
            return null;
        }

        $tokenHash = hash('sha256', $_COOKIE['SESSION_TOKEN']);

        $stmt = $this->db->prepare("
        SELECT u.*
        FROM sessions s
        JOIN users u ON u.id = s.user_id
        WHERE s.token = :token
          AND s.expiredIn > NOW()
        LIMIT 1
    ");

        $stmt->execute(['token' => $tokenHash]);
        return $stmt->fetch();
    }


    public function removeSession(string $token) {
        $stmt = $this->db->prepare("DELETE FROM sessions WHERE token = :t");
        $stmt->execute([
            't' => hash('sha256', $token)
        ]);
    }

    public function getUserInformation(string $userId)
    {
        $query = "
        SELECT
            u.id AS user_id,
            u.username AS username,
            u.name AS user_name,
            u.surname AS surname,
            u.email AS email,
            r.title AS role,
            (r.title = 'admin') AS isAdmin
        FROM users u
        JOIN roles r ON r.id = u.role_id
        WHERE u.id = :userId
        LIMIT 1
    ";

        $stmt = $this->db->prepare($query);
        $stmt->execute([
            ':userId' => $userId
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


}
