<?php

namespace snippets;

use Serializable;

class DSN implements Serializable
{
    private string $driver;
    private string $host;
    private string $port;
    private string $database;
    private string $user;
    private string $password;

    public function __construct (string $driver,
                                 string $port,
                                 string $database,
                                 string $user,
                                 string $password,
                                 string $host)
    {
        $this->driver=$driver;
        $this->host=$host;
        $this->port=$port;
        $this->database=$database;
        $this->user=$user;
        $this->password=$password;
    }

    public function __toString (): string
    {
        return "
        {$this->driver}:
        host={$this->host};
        port={$this->port};
        dbname={$this->database};
        password={$this->password};
        user={$this->user}";
    }

    public function __serialize (): array
    {
        return [
            "driver"  =>$this->driver,
            "host"    =>$this->host,
            "port"    =>$this->port,
            "database"=>$this->database,
            "user"    =>$this->user,
            "password"=>$this->password
        ];
    }

    public function __unserialize (array $data): void
    {
        $this->driver=$data["driver"];
        $this->host=$data["host"];
        $this->port=$data["port"];
        $this->database=$data["database"];
        $this->user=$data["user"];
        $this->password=$data["password"];
    }

    #[Override] public function serialize ()
    {
        error_log("Método obsoleto");
        throw Deprecated::PHP_VERSIONS;
    }

    #[Override] public function unserialize (string $data)
    {
        throw Deprecated::PHP_VERSIONS;
    }


}