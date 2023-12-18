<?php

namespace App\Model;
require "..\utils\crypt.php";

class PwdHash
{

    private readonly string $pwdHash;
    private bool $isValid;

    public function __construct(string $pwdHash)
    {
        $this->pwdHash = $pwdHash;
        $this->isValid = true;
    }

    public function invalidate(): void
    {
        $this->isValid = false;
    }

    public function isValid(): bool
    {
        return $this->isValid;
    }

    public function getPwdHash(): string
    {
        if (!$this->isValid) {
            throw new \Exception("This PwdHash is no longer valid.");
        }
        return $this->pwdHash;
    }

}