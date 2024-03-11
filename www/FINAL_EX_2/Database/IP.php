<?php

namespace Database;

class IP implements \Serializable
{
    private int $ipv4;

    public function __construct(string | int $ipv4)
    {
        if (is_string($ipv4)) {
            $this->ipv4 = ip2long($ipv4);
        } else if (is_int($ipv4)) {
            $this->ipv4 = $ipv4;
        }
    }

    public function __toString(): string
    {
        return long2ip($this->ipv4);
    }

    public function __serialize(): array
    {
        return ["ipv4" => $this->ipv4];
    }

    public function __unserialize(array $data): void
    {
        $this->ipv4 = $data["ipv4"];
    }

    public function __destruct()
    {
        error_log("Instancia de " . __CLASS__ . " destructora");
    }

    /**
     * @throws \Exception
     */
    #[\Override] public function serialize()
    {
        error_log("Método obsoleto");
        throw new \Exception("Método obsoleto");
    }

    /**
     * @throws \Exception
     */
    #[\Override] public function unserialize(string $data)
    {
        error_log("Método obsoleto");
        throw new \Exception("Método obsoleto");
    }
}