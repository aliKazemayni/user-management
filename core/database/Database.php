<?php

namespace Core\Database;

use Exception;
use PDO;
use PDOException;

class Database
{
    private static ?PDO $connection = null;

    private static function getConnectionString(): string
    {
        $host = $_ENV['DB_HOST'] ?? 'localhost';
        $db   = $_ENV['DB_NAME'] ?? 'my_database';
        $port = $_ENV['DB_PORT'] ?? 3306;

        return "mysql:host=$host;dbname=$db;port=$port;charset=utf8mb4";
    }

    public static function connect()
    {
        if (self::$connection === null) {
            try {

                $user = $_ENV['DB_USER'] ?? 'root';
                $pass = $_ENV['DB_PASS'] ?? '';

                self::$connection = new PDO(self::getConnectionString(), $user, $pass);
                self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            } catch (PDOException|Exception $exception) {
                die($exception->getMessage());
            }
        }

        return self::$connection;
    }
}