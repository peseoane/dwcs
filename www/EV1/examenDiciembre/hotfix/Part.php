<?php
declare(strict_types=1);

namespace App;
require "sanitize.php";

class Part
{
    private string $uuid;
    private string $partName;

    public function __construct(string $partName)
    {
        $this->uuid = uniqid();
        $this->partName = sanitizeString($partName);
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function getPartName(): string
    {
        return $this->partName;
    }
}
