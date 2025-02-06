<?php

declare(strict_types=1);

namespace App;

use PDO;
use PDOException;
use Dotenv\Dotenv;

class Database {
    private PDO $connection;

    public function __construct() {
        //This will take you 2 directories up
        $dotEnv = Dotenv::createImmutable(dirname(__DIR__, 2)); 
        $dotEnv->load();

        try {
            $databaseUrl = "mysql:host={$_ENV['DB_HOST']};dbname={$_ENV['DB_NAME']};charset={$_ENV['DB_CHARSET']}";
            $this->connection = new PDO($databaseUrl, $_ENV['DB_USER'], $_ENV['DB_PASS'], [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
        } catch (PDOException $exception) {
            die("Database connection failed: " . $exception->getMessage());
        }
    }

    public function connect(): PDO {
        return $this->connection;
    }
}
