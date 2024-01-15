<?php
declare (strict_types=1);

class dbUtils
{
    readonly private string $MYSQL_USER;
    readonly private string $MYSQL_ROOT_PASSWORD;
    readonly private string $MYSQL_HOST;
    readonly private string $MYSQL_DB;
    readonly private string $MYSQL_DSN;
    static int $instanceCount = 0;

    public function __construct(string $configFilePath)
    {
        error_log("dbUtils constructor: number of instances: " . self::$instanceCount++);
        $db_config = $this->getDataFromConfigFile($configFilePath);
        $this->MYSQL_USER = $db_config["MYSQL_USER"];
        $this->MYSQL_ROOT_PASSWORD = $db_config["MYSQL_ROOT_PASSWORD"];
        $this->MYSQL_HOST = $db_config["MYSQL_HOST"];
        $this->MYSQL_DB = $db_config["MYSQL_DB"];
        $this->MYSQL_DSN = "mysql:host=" . $this->MYSQL_HOST . ";dbname=" . $this->MYSQL_DB;
    }

    private function getDataFromConfigFile(string $configFilePath): mixed
        /** any vibes... */
    {
        return parse_ini_file($configFilePath);
    }

    public function getPdo(): PDO|false
    {
        try {
            $pdo = new PDO($this->MYSQL_DSN, $this->MYSQL_USER, $this->MYSQL_ROOT_PASSWORD);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            error_log("Connected successfully to: " . $this->MYSQL_DSN);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            error_log("Connection failed: " . $e->getMessage());
            return false;
        } finally {
            error_log("Finally block");
            return $pdo;
        }
    }
}