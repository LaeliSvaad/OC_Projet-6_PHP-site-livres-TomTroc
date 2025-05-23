<?php

/**
 * Entité Book
 */
class Book extends AbstractEntity
{
    private string $title;
    private string $description;
    private Author $author;


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

}