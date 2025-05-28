<?php

/**
 * Entité Book
 */
class Book extends AbstractEntity
{
    private string $title;
    private string $description;
    private Author $author;
    private User $user;

    protected int $id;

    public function setId(int $id) : void
    {
        $this->id = $id;
    }

    public function getId() : int
    {
        return $this->id;
    }

    public function setTitle(string $title) : void
    {
        $this->title = $title;
    }

    public function getTitle() : string
    {
        return $this->title;
    }

    public function setDescription(string $description) : void
    {
        $this->description = $description;
    }

    public function getDescription() : string
    {
        return $this->description;
    }

    /*public function setPicture(string $picture) : void
    {
        $this->picture = $picture;
    }*/

    public function setAuthor(Author $author) : void
    {
        $this->author = $author;
    }

    public function getAuthor() : string
    {
        return $this->author;
    }

    public function setUser(User $user) : void
    {
        $this->user = $user;
    }

    public function getUser() : string
    {
        return $this->user;
    }

}