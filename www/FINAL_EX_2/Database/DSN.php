<?php

namespace Database;

use Control\ObjetoBase;

class DSN extends ObjetoBase implements \Serializable
{
    private string $driver;
    private string $host;
    private string $port;
    private string $dbname;
    private string $user;
    private string $password;


    public function __construct (string $driver,
                                 string $host,
                                 string $port,
                                 string $dbname,
                                 string $user,
                                 string $password)
    {
        $this->driver=$driver;
        $this->host=$host;
        $this->port=$port;
        $this->dbname=$dbname;
        $this->user=$user;
        $this->password=$password;
    }

    public function __toString (): string
    {
        return $this->driver . ":host=" . $this->host . ";port=" . $this->port . ";dbname=" . $this->dbname . ";user=" . $this->user . ";password=" . $this->password;
    }

    public function __destruct()
    {
        error_log("Instancia de " . __CLASS__ . " destructora");
    }

    public function __serialize(): array
    {
        return ["driver" => $this->driver,
                "host" => $this->host,
                "port" => $this->port,
                "dbname" => $this->dbname,
                "user" => $this->user,
                "password" => $this->password];
    }

    public function __unserialize(array $data): void
    {
        $this->driver = $data["driver"];
        $this->host = $data["host"];
        $this->port = $data["port"];
        $this->dbname = $data["dbname"];
        $this->user = $data["user"];
        $this->password = $data["password"];
    }

}