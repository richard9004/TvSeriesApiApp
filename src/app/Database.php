<?php

declare(strict_types=1);
namespace App;

use PDO;
use PDOException;
use Dotenv\Dotenv;

class Database
{
    private static ?PDO $connection = null;
    public function __construct(
        private string $host,
        private string $name,
        private string $user,
        private string $password
    ) {
    }

    public function getConnection(): PDO
    {
        if (self::$connection === null) {
            $dsn = "mysql:host={$this->host};dbname={$this->name};charset=utf8";
            self::$connection =  new PDO($dsn, $this->user, $this->password, [
                PDO::ATTR_EMULATE_PREPARES=>false,
                PDO::ATTR_STRINGIFY_FETCHES=>false
            ]);
        }
        return self::$connection;
        
    }
}