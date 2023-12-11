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

    private function connect(): void
    {
        try {
            $this->connection = new PDO(self::DSN, self::USER, self::PASSWORD);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function dump(): void
    {
        var_dump($this->connection);
    }

    public function deleteAllUserInformation(): void
    {
        $this->ensureConnection();
        // Because sometimes connections just magically disappear.
        // PHP, the master of disappearing acts.
        // If only real magic was this unreliable.
        try {
            $this->connection->exec("DELETE FROM users");
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
    // this needs to be fixed. ... Of course, I'd also suggest that whoever was the genius who thought it was a good idea
    // to connect to the database ONE F*CKING TIME PER POOL AT A TIME should be retroactively aborted.
    //
    // Who the f*ck does idiotic things like that? How did they noty die as babies, considering that they were likely too stupid
    // to find a tit to suck on? PDO::__construct should handle that... and PDOStatement should take care... but nope.
    //
    // Yeah, I'm looking at you, PDO. The king of making simple things unnecessarily complicated. Connecting to a database
    // shouldn't feel like a journey through hell. Aborting babies might be a bit extreme, but whoever designed this deserves
    // a serious reality check.

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
                email VARCHAR(255) NOT NULL UNIQUE ,
                surname VARCHAR(30) NOT NULL,
                username VARCHAR(30) NOT NULL UNIQUE ,
                password VARCHAR(255) NOT NULL UNIQUE ,
                dob DATE NOT NULL,
                file_path VARCHAR(255)
            )");
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    /*
    public function insertBlob(string $filePath, string $mime): void
    {
        $this->ensureConnection();

        try {
            $blob = fopen($filePath, 'rb');

            $sql = "INSERT INTO users (mime, data) VALUES(:mime, :data)";
            $stmt = $this->connection->prepare($sql);

            $stmt->bindParam(':mime', $mime);
            $stmt->bindParam(':data', $blob, PDO::PARAM_LOB);

            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    */

    public function loginUser(string $username, string $password): void
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


    public function addUser(string $username, string $surname, string $dob, string $email, string $password, ?string $filePath): void
    {
        $this->ensureConnection();

        try {
            $stmt = $this->connection->prepare("INSERT INTO users (username, surname, dob, email, password, file_path) VALUES (:username, :surname, :dob, :email, :password, :file_path)");
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':surname', $surname);
            $stmt->bindParam(':dob', $dob);
            $stmt->bindParam(':email', $email);
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            $stmt->bindParam(':password', $passwordHash);
            $stmt->bindParam(':file_path', $filePath);

            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }


    public function checkPassword(string $email, string $password): bool
    {
        $this->ensureConnection();

        try {
            $stmt = $this->connection->prepare("SELECT password FROM users WHERE email = :email");
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row && isset($row['password'])) {
                error_log("Stored password hash: " . $row['password']);
                error_log("Provided password hash: " . password_hash($password, PASSWORD_DEFAULT));
                $passwordMatches = password_verify($password, $row['password']);
                error_log("Password matches: " . var_export($passwordMatches, true));
                return $passwordMatches;
            } else {
                error_log("No user found with email: " . $email);
                return false;
            }
        } catch (PDOException $e) {
            error_log("PDOException: " . $e->getMessage());
            return false;
        }
    }

    public function getUsersAndHashes(): array
    {
        $this->ensureConnection();

        try {
            $stmt = $this->connection->prepare("SELECT * FROM users");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return [];
        }
    }

}

?>