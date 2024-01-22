<?php
declare (strict_types=1);

require_once "SingletonTrait.php";

class DbCon
{
    use SingletonTrait;
    readonly private string $MYSQL_USER;
    readonly private string $MYSQL_ROOT_PASSWORD;
    readonly private string $MYSQL_HOST;
    readonly private string $MYSQL_DB;
    readonly private string $MYSQL_DSN;
    readonly private string $configFilePath;
    private PDO $PDO;

    /*
     * We're going to use the singleton pattern to avoid creating multiple instances of the same object.
     * This is why this is PROTECTED, a private constructor yes, this way only the "mother" class can create
     * an instance of this class.
     */
    protected function __construct()
    {
        $this->configFilePath = ".db";
        $db_config = $this->getDataFromConfigFile($this->configFilePath);
        $this->MYSQL_USER = $db_config["MYSQL_USER"];
        $this->MYSQL_ROOT_PASSWORD = $db_config["MYSQL_ROOT_PASSWORD"];
        $this->MYSQL_HOST = $db_config["MYSQL_HOST"];
        $this->MYSQL_DB = $db_config["MYSQL_DB"];
        $this->MYSQL_DSN = "mysql:host=" . $this->MYSQL_HOST . ";dbname=" . $this->MYSQL_DB;
        $this->PDO = (new PDO($this->MYSQL_DSN, $this->MYSQL_USER, $this->MYSQL_ROOT_PASSWORD));
        $this->PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        self::$instance = $this;
    }

    private function getDataFromConfigFile(string $configFilePath): array|false
    {
        return parse_ini_file($configFilePath);
    }

    /**
     * @Description: This method will return the PDO object, should not be used by the user directly.
     * @return PDO|false
     */
    private function getPdo(): PDO|false
    {
        return $this->PDO;
    }

    /**
     * @Description: This method will run a query with the SQL sentence and params provided.
     * @param string $SQLSentence SQL sentence to execute.
     * @param array $params Array of params to execute. If none provided, an empty array will be used.
     * @return array
     */
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
            return [

            ];
        } finally {
            return $result;
        }
    }


    /**
     * @Description: This method will run a transaction with the SQL sentences and params provided.
     * @param array $SQLSentences Array of SQL sentences to execute.
     * @param array $params Array of params to execute. If none provided, an empty array will be used.
     * @return bool
     */
    public function runTransactions(array $SQLSentences, array $params = []): bool
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


    /**
     * @Description: This method will return the headers of a SQL result, but handling possible errors.
     * @param array $SQLRESULLT
     * @return array
     * @throws PDOException
     */
    public function getHeaders(array $SQLRESULLT): array
    {
        if (empty($SQLRESULLT)) {
            // Handle empty result set here
            return [];
        }

        $headers = array_keys($SQLRESULLT[0]);
        error_log("Headers obtained successfully");
        return $headers;
    }

    public function runQuerySingle(string $query): string | int
    {
        try {
            $stmt = $this->getPdo()->prepare($query);
            $stmt->execute();
            $result = $stmt->fetchColumn();
            error_log("Query executed successfully: " . $query);
        } catch (PDOException $e) {
            echo "Query failed: " . $e->getMessage();
            error_log("Query failed: " . $e->getMessage());
            return "";
        } finally {
            return $result;
        }
    }


}