<?php
declare(strict_types=1);

namespace Database;

use Exception;
use PDO;
use PDOException;

class SqlBuilder
{

    use Singleton;

    private const string pathToIni=__DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "config.ini";
    private PDO $pdo;
    private DSN $dsn;

    private function __construct ()
    {
        $config=parse_ini_file(self::pathToIni);
        $this->dsn=new DSN($config['driver'],
                           $config['host'],
                           $config['port'],
                           $config['dbname'],
                           $config['user'],
                           $config['password']);
        $this->pdo=new PDO($this->dsn->__toString());
    }

    public function withQuery (string $query): array
    {
        $CACHE=$this->pdo->prepare($query);
        $CACHE->execute();
        return $CACHE->fetchAll(PDO::FETCH_ASSOC);
    }

    public function withQueryAndParams (string $query, array $params): array
    {
        try {
            $CACHE=$this->pdo->prepare($query);

            foreach ($params as $key=>&$value) {
                $CACHE->bindParam(':' . $key, $value);
            }

            $CACHE->execute();
            return $CACHE->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return ["error"=>$e->getMessage()];
        }
    }

    /**
     * @throws Exception
     */
    public function runTransactionsWithParams(array $transactions): array
    {
        try {
            $this->pdo->beginTransaction();
            foreach ($transactions as $transaction) {
                [$query, $params] = $transaction;
                $CACHE = $this->pdo->prepare($query);
                if (isset($params)) {
                    foreach ($params as $key => $value) {
                        $CACHE->bindValue(':' . $key, $value);
                    }
                }
                $CACHE->execute();
            }
            $this->pdo->commit();
            return ["success" => "Transacción completada"];
        } catch (PDOException $e) {
            $this->pdo->rollBack();
            throw new Exception("Error al ejecutar transacciones: " . $e->getMessage());
        }
    }

    public function runTransactions(array $queries): array
    {
        try {
            $this->pdo->beginTransaction();
            foreach ($queries as $query) {
                $CACHE = $this->pdo->prepare($query);
                $CACHE->execute();
            }
            $this->pdo->commit();
            return ["success" => "Transacción completada"];
        } catch (PDOException $e) {
            $this->pdo->rollBack();
            throw new Exception("Error al ejecutar transacciones: " . $e->getMessage());
        }
    }
}