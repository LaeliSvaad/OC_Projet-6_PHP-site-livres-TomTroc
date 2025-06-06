<?php

/**
 * Classe qui gère la bibliothèque
 */
class LibraryManager extends AbstractEntityManager
{
    public function getAvailableBooks(): ?Library
    {
        $status = BookStatus::AVAILABLE->value;
        $sql = "SELECT
                    `user`.nickname, 
                    `user`.email,
                    `user`.id AS userId,
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
                WHERE `library`.`status` = :status";

        $result = $this->db->query($sql, ['status' => $status]);
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