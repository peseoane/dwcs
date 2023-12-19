<?php
declare(strict_types=1);

class User
{
    private string $email;
    private string $hashedPassword;
    private string $path;

    /**
     * @throws Exception if email is not valid
     */
    public function __construct(string $email, string $password)
    {
        if (!validateEmail($email)) {
            error_log("Invalid email, parsed email: -> " . $email . " <-");
            var_dump($email);
            throw new Exception("Invalid email");
        }
        $this->email = $email;
        $this->hashedPassword = hash('sha256', $password);
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getHashedPassword(): string
    {
        return $this->hashedPassword;
    }

    public function setHashedPassword(string $hashedPassword): void
    {
        $this->hashedPassword = $hashedPassword;
    }

    public function getPath(): Path
    {
        return $this->path;
    }

    public function setPath(string $path): void
    {
        $this->path = $path;
    }
}