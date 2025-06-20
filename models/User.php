<?php

/**
 * Entité User
 */
class User extends AbstractEntity
{
    private string $nickname;
    private string $email;
    private string $password;
    private string $picture;
    private int $userId;
    /*private ?Library $library;*/

    public function setUserId(int $id) : void
    {
        $this->userId = $id;
    }

   /* public function setLibrary(?Library $library) : void
    {
        $this->library = $library;
    }*/

    /*public function getLibrary() : ?Library
    {
        return $this->library;
    }*/

    public function setNickname(string $nickname) : void
    {
        $this->nickname = $nickname;
    }

    public function setPicture(string $picture) : void
    {
        $this->picture = $picture;
    }

    public function setEmail(string $email) : void
    {
        $this->email = $email;
    }
    public function setPassword(string $password) : void
    {
        $this->password = $password;
    }

    public function getUserId() : int
    {
        return $this->userId;
    }

    public function getNickname() : string
    {
        return $this->nickname;
    }

    public function getPicture() : string
    {
        return $this->picture;
    }

    public function getEmail() : string
    {
        return $this->email;
    }

    public function getPassword() : ?string
    {
        return $this->password;
    }

    /*public function __toString() : string
    {
        return $this->nickname . ' ' . $this->email;
    }*/
}