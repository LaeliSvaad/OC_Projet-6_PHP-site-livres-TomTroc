<?php

/**
 * Entité User
 */
class User extends AbstractEntity
{
    private string $nickname;
    private string $email;
    private string $password;
    /*private Date $registrationDate;*/

    public function setNickname(string $nickname) : void
    {
        $this->nickname = $nickname;
    }

    public function setEmail(string $email) : void
    {
        $this->email = $email;
    }
    public function setPassword(string $password) : void
    {
        $this->password = $password;
    }

    public function getNickname() : string
    {
        return $this->nickname;
    }

    public function getEmail() : string
    {
        return $this->email;
    }

    public function getPassword() : ?string
    {
        return $this->password;
    }

    public function __toString() : string
    {
        return $this->nickname . ' ' . $this->email;
    }
}