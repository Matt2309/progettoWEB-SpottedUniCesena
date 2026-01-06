<?php

class Database {
    private static ?PDO $instance = null;
    private PDO $db;

    public function __construct()
    {
        $this->db = self::getConnection();
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
}
