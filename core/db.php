<?php

class Database {
    private static ?PDO $instance = null;

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
}
