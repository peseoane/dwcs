<?php

namespace Database;

use Control\ObjetoBase;
use Control\Uniformidad;

/**
 * Class DSN - Para guardar la información de conexión a la base de datos de modo más cómodo.
 * @package Database
 */
class DSN extends ObjetoBase implements Uniformidad
{
    private string $driver;
    private string $host;
    private string $port;
    private string $database;
    private string $user;
    private string $password;

    public function __construct(string $driver, string $port, string $database, string $user, string $password, string $host)
    {
        $this->driver = $driver ?? "mysql";
        $this->host = $host ?? "localhost";
        $this->port = $port ?? 3307;
        $this->database = $database ?? "examen";
        $this->user = $user ?? "root";
        $this->password = $password ?? "root";
    }

    public function __toString(): string
    {
        return "{$this->driver}:host={$this->host};port={$this->port};dbname={$this->database};password={$this->password};user={$this->user}";
    }

    public function __serialize(): array
    {
        return [
            "driver"   => $this->driver,
            "host"     => $this->host,
            "port"     => $this->port,
            "database" => $this->database,
            "user"     => $this->user,
            "password" => $this->password
        ];
    }

    public function __unserialize(array $data): void
    {
        $this->driver = $data["driver"];
        $this->host = $data["host"];
        $this->port = $data["port"];
        $this->database = $data["database"];
        $this->user = $data["user"];
        $this->password = $data["password"];
    }

}