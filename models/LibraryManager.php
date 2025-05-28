<?php

/**
 * Classe qui gère la bibliothèque
 */
class LibraryManager extends AbstractEntityManager
{
    public function getAvailableBooks(): ?Library
    {
        $sql = "SELECT library.book_id, library.user_id, library.status,
                user.nickname, user.email,
                book.title, book.description, book.picture, book.author_id, book.id,
                author.firstname, author.lastname, author.pseudo, author.id as author_id
                FROM library 
                INNER JOIN user ON library.user_id = user.id
                INNER JOIN book ON library.book_id = book.id 
                INNER JOIN author ON book.author_id = author.id 
                WHERE library.status = 'AVAILABLE'";

        $result = $this->db->query($sql);
        $library = new Library();
        foreach ($result as $element) {
            $element["author"] = new Author($element);
            $element["user"] = new User($element);
            $book = new Book($element);
            $library->addBook($book);
        }
        return $library;
    }
}