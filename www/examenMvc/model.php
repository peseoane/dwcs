<?php
declare(strict_types=1);

class Database
{
    private const DATABASE_NAME = 'dwcs';
    private const USER = 'root';
    private const PASSWORD = 'root';
    private const HOST = 'mysql';
    private const DSN = 'mysql:host=' . self::HOST . ';dbname=' . self::DATABASE_NAME;

    private PDO $connection;

    public function __construct()
    {
        $this->connect();
    }

    public function dump(): void
    {
        var_dump($this->connection);
    }

    private function connect(): void
    {
        try {
            $this->connection = new PDO(self::DSN, self::USER, self::PASSWORD);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    private function ensureConnection(): void
    {
        if (!isset($this->connection)) {
            $this->connect();
        }
    }

    public function checkIfDbExists(): bool
    {
        $this->ensureConnection();

        try {
            $stmt = $this->connection->query("SELECT 1 FROM " . self::DATABASE_NAME . " LIMIT 1");
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function createDb(): void
    {
        $this->ensureConnection();

        try {
            $this->connection->exec("CREATE DATABASE IF NOT EXISTS " . self::DATABASE_NAME);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function checkIfTableExists(): bool
    {
        $this->ensureConnection();

        try {
            $stmt = $this->connection->query("SELECT 1 FROM users LIMIT 1");
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function createTable(): void
    {
        $this->ensureConnection();

        try {
            $this->connection->exec("CREATE TABLE IF NOT EXISTS users (
                id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                username VARCHAR(30) NOT NULL,
                password VARCHAR(255) NOT NULL
            )");
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function addUser(string $username, string $password): void
    {
        $this->ensureConnection();

        try {
            $stmt = $this->connection->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
            $stmt->bindParam(':username', $username);
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            $stmt->bindParam(':password', $passwordHash);
            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function checkPassword(string $username, string $password): bool
    {
        $this->ensureConnection();

        try {
            $stmt = $this->connection->prepare("SELECT password FROM users WHERE username = :username");
            $stmt->bindParam(':username', $username);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row && isset($row['password'])) {
                return password_verify($password, $row['password']);
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function getUsersAndHashes(): array
    {
        $this->ensureConnection();

        try {
            $stmt = $this->connection->prepare("SELECT username, password FROM users");
            $stmt->execute();

            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $rows;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return [];
        }
    }

}

?>