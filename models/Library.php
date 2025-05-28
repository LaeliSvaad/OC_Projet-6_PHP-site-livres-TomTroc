<?php

/**
 * Entité Bibliothèque
 */
class Library extends AbstractEntity
{
    private array $library = [];

    public function addBook(Book $book): void {
        $this->library[] = $book;
    }

    public function getLibrary(): array {
        return $this->library;
    }

}