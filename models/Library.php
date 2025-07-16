<?php

/**
 * Entité Bibliothèque
 */
class Library extends AbstractEntity
{
    private array $library = [];

    private int $bookNumber;

    public function addBook(Book $book): void {
        $this->library[] = $book;
    }

    public function getLibrary(): array {
        return $this->library;
    }

    public function setBookNumber(int $bookNumber): void
    {
        $this->bookNumber = $bookNumber;
    }

    public function getBookNumber(): int
    {
        return $this->bookNumber;
    }
}