<?php
namespace App;


class User
{

    private Email $email;
    private PwdHash $pwdHash;

    public function __construct(string $email, string $pwdHash)
    {
        $this->email = $email;
        $this->pwdHash = $pwdHash;
    }

    public function getEmail(): Email
    {
        return $this->email->getEmail();
    }

    /**
     * @throws \Exception in case of "" attack "" or just misuse...
     */
    public function getPwdHash(): PwdHash
    {
        return $this->pwdHash->getPwdHash();
    }

    // TODO: HASH INVALIDATION, ORPHANED OBJECTS, ETC...

}