<?php
declare (strict_types=1);

require_once "singleton.php";

class dbUtils extends Singleton
{
    readonly private string $MYSQL_USER;
    readonly private string $MYSQL_ROOT_PASSWORD;
    readonly private string $MYSQL_HOST;
    readonly private string $MYSQL_DB;
    readonly private string $MYSQL_DSN;
    readonly private string $configFilePath;
    protected PDO $PDO; // singleton util... should be not static innit??

    public function __construct()
    {
        parent::__construct();
        $this->configFilePath = ".db";
        $db_config = $this->getDataFromConfigFile($this->configFilePath);
        $this->MYSQL_USER = $db_config["MYSQL_USER"];
        $this->MYSQL_ROOT_PASSWORD = $db_config["MYSQL_ROOT_PASSWORD"];
        $this->MYSQL_HOST = $db_config["MYSQL_HOST"];
        $this->MYSQL_DB = $db_config["MYSQL_DB"];
        $this->MYSQL_DSN = "mysql:host=" . $this->MYSQL_HOST . ";dbname=" . $this->MYSQL_DB;
        $this->PDO = (new PDO($this->MYSQL_DSN, $this->MYSQL_USER, $this->MYSQL_ROOT_PASSWORD));
        $this->PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    private function getDataFromConfigFile(string $configFilePath): array|false
        /** any vibes... */
    {
        return parse_ini_file($configFilePath);
    }

    public function getPdo(): PDO|false
    {
        return $this->PDO;
    }

    public function runQueryAssoc(string $SQLSentence, array $params = []): array
    {
        try {
            $stmt = $this->getPdo()->prepare($SQLSentence);
            $stmt->execute($params);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            error_log("Query executed successfully: " . $SQLSentence);
        } catch (PDOException $e) {
            echo "Query failed: " . $e->getMessage();
            error_log("Query failed: " . $e->getMessage());
            return [];
        } finally {
            return $result;
        }
    }


    public function runTransactions(array $SQLSentences, array $params): bool
    {
        try {
            $state = $this->getPdo();
            $state->beginTransaction();
            for ($i = 0; $i < count($SQLSentences); $i++) {
                $stmt = $state->prepare($SQLSentences[$i]);
                $stmt->execute($params[$i]);
                error_log("Transaction executed successfully: " . $SQLSentences[$i] . " with params: " . json_encode($params[$i]));
            }
            $state->commit();
            error_log("Transaction executed successfully:");
        } catch (PDOException $e) {
            $state->rollBack();
            error_log("Transaction failed: " . $e->getMessage());
            return false;
        } finally {
            return true;
        }
    }


    public function getHeaders(array $SQLRESULLT): array
    {
        try {
            $headers = array_keys($SQLRESULLT[0]);
            error_log("Headers obtained successfully");
        } catch (PDOException $e) {
            error_log("Headers failed: ¿Empty space?" . $e->getMessage());
            return ["YO, THERE WAS AN ATTEMPT TO ACCESS AN EMPTY SPACE"];
        } finally {
            return $headers;
        }
    }

    public function freePdo(): void
    {
        // TODO: Implement freePdo() method.
    }

}