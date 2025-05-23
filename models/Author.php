<?php

/**
 * Entité Author
 */
class Author extends AbstractEntity
{
    private string $firstname;
    private string $lastname;
    private ?string $pseudo;

    public function setFirstname(string $firstname) : void
    {
        $this->firstname = $firstname;
    }

    public function setLastname(string $lastname) : void
    {
        $this->lastname = $lastname;
    }
    public function setPseudo(?string $pseudo) : void
    {
        $this->pseudo = $pseudo;
    }

    public function getFirstname() : string
    {
        return $this->firstname;
    }

    public function getLastname() : string
    {
        return $this->lastname;
    }

    public function getPseudo() : ?string
    {
        return $this->pseudo;
    }

    public function __toString() : string
    {
        if($this->pseudo != null)
            return $this->firstname . ' ' . $this->lastname . ' (' . $this->pseudo . ')';
        else
            return $this->firstname . ' ' . $this->lastname;
    }
}