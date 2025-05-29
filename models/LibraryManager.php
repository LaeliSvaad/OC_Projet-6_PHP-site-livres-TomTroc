<?php

/**
 * Classe qui gère la bibliothèque
 */
class LibraryManager extends AbstractEntityManager
{
    public function getAvailableBooks(): ?Library
    {
        $sql = "SELECT
                    `user`.nickname, 
                    `user`.email,
                    `book`.title, 
                    `book`.description, 
                    `book`.picture, 
                    `book`.id,
                    `author`.firstname, 
                    `author`.lastname, 
                    `author`.pseudo
                FROM `library`
                INNER JOIN `user` ON `user`.`id` = `library`.`user_id`
                INNER JOIN `book` ON `library`.`book_id` = `book`.`id`
                INNER JOIN `author` ON `author`.`id` = `book`.`author_id`
                WHERE `library`.`status` = BookStatus::AVAILABLE";

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