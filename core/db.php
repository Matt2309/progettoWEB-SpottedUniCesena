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
        $query = "SELECT username FROM Users";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //lista commenti per un certo utente
    public function getCommentUser($username){
        $query = "SELECT * FROM Comments, Users WHERE username=usernameComments AND username = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    //lista commenti spotted
    public function getCommentSpotted($title){
        $query = "SELECT * FROM Spotted, Comments WHERE title=titleComments AND title = :title";
        $stmt = $this->db->prepare($query);
        $stmt->execute([':title' => $title]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //bannare utente
    public function userBan($username){
        $query = "UPDATE Users SET isBanned=true WHERE username=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $username);
        return $stmt->execute();
    }

    //sbannare utente
    public function userSban($username){
        $query = "UPDATE Users SET isBanned=false WHERE username=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $username);
        return $stmt->execute();
    }

    //accettazione spotted
    public function spottedOk($title){
        $query = "UPDATE Spotted SET state=ACCEPTED WHERE title=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $title);
        return $stmt->execute();
    }
}
