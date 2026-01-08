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
        $query = "SELECT * FROM spotted WHERE status = :status";
        $stmt = $this->db->prepare($query);
        $stmt->execute([
            ':status' => 'APPROVED'
        ]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    //lista spotted per utente
    public function getSpottedUser($userId) {
        $query = "SELECT * FROM spotted WHERE user_id = :user_id";
        $stmt = $this->db->prepare($query);
        $stmt->execute(['user_id' => $userId]);
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
        $query = "SELECT text FROM comments WHERE comments.user_id = :userId";
        $stmt = $this->db->prepare($query);
        $stmt->execute(['userId' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //lista commenti spotted
    public function getCommentSpotted($spottedId){
        $query = "SELECT * FROM comments WHERE spotted_id = :spottedId";
        $stmt = $this->db->prepare($query);
        $stmt->execute([':spottedId' => $spottedId]);
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

}
