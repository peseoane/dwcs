<?php
declare(strict_types=1);

namespace Database;

use PDO;
use PDOException;

class SqlBuilder
{

    use Singleton;

    private const string pathToIni = __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "config.ini";
    private PDO $pdo;
    private DSN $dsn;

    private function __construct()
    {
        $config = parse_ini_file(self::pathToIni);
        $this->dsn = new DSN($config["driver"], $config["port"], $config["database"], $config["user"], $config["password"], $config["host"]);
        $this->pdo = new PDO((string)$this->dsn);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function withQuery(string $query): array
    {
        $CACHE = $this->pdo->prepare($query);
        $CACHE->execute();
        return $CACHE->fetchAll(PDO::FETCH_ASSOC);
    }

    public function withQueryAndParams(string $query, array $params): array
    {
        try {
            $CACHE = $this->pdo->prepare($query);

            foreach ($params as $key => &$value) {
                $CACHE->bindParam(':' . $key, $value);
            }

            $CACHE->execute();
            return $CACHE->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return ["error" => $e->getMessage()];
        }
    }


}