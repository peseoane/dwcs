<?php
declare(strict_types=1);

class Email
{
    private string $emailAddress;

    public function __construct(string $email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->emailAddress = $email;
        } else {
            throw new Exception('Invalid email');
        }
    }

    public function getEmailAddress(): string
    {
        return $this->emailAddress;
    }
}

class Password
{
    private string $password;
    private string $passwordHash;

    public function __construct(string $password)
    {
        $this->password = $password;
        $this->passwordHash = password_hash($password, PASSWORD_DEFAULT);
    }

    public function validatePassword(string $password): bool
    {
        return password_verify($password, $this->passwordHash);
    }

}

class Form
{
    private Email $email;
    private Password $password;

    public function __construct(Email $email, Password $password)
    {
        $this->email = $email;
        $this->password = $password;
    }

}