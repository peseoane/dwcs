<?php
namespace App;

class Email
{
    private string $email;

    /**
     * @throws Exception trivial error?
     */
    public function __construct(string $email)
    {
        if (sanitizeEmail($email)) {
            $this->email = $email;
        } else {
            throw new Exception("Invalid email");
        }
    }

    public function getEmail(): string
    {
        return $this->email;
    }
}
