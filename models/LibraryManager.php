<?php

/**
 * Classe qui gère la bibliothèque
 */
class LibraryManager extends AbstractEntityManager
{
    public function getAvailableBooks(): ?Library
    {
        $status = BookStatus::AVAILABLE->value;
        $action = Utils::request('action', 'home');
        if($action == "home")
        {
            $sql = "SELECT
                    `user`.nickname, 
                    `user`.id AS userId,
                    `book`.title, 
                    `book`.description, 
                    `book`.picture AS bookPicture, 
                    `book`.id,
                    `author`.firstname, 
                    `author`.lastname, 
                    `author`.pseudo
                FROM `library`
                INNER JOIN `user` ON `user`.`id` = `library`.`user_id`
                INNER JOIN `book` ON `library`.`book_id` = `book`.`id`
                INNER JOIN `author` ON `author`.`id` = `book`.`author_id`
                WHERE `library`.`status` = :status LIMIT 4";
        }
        else
        {
            $sql = "SELECT
                    `user`.nickname, 
                    `user`.id AS userId,
                    `book`.title, 
                    `book`.description, 
                    `book`.picture AS bookPicture, 
                    `book`.id,
                    `author`.firstname, 
                    `author`.lastname, 
                    `author`.pseudo
                FROM `library`
                INNER JOIN `user` ON `user`.`id` = `library`.`user_id`
                INNER JOIN `book` ON `library`.`book_id` = `book`.`id`
                INNER JOIN `author` ON `author`.`id` = `book`.`author_id`
                WHERE `library`.`status` = :status";
        }

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

    public function getBooksByTitle(string $title): ?Library
    {
        $status = BookStatus::AVAILABLE->value;
        $sql = "SELECT
                    `user`.nickname, 
                    `user`.id AS userId,
                    `book`.title, 
                    `book`.description, 
                    `book`.picture AS bookPicture, 
                    `book`.id,
                    `author`.firstname, 
                    `author`.lastname, 
                    `author`.pseudo
                FROM `library`
                INNER JOIN `user` ON `user`.`id` = `library`.`user_id`
                INNER JOIN `book` ON `library`.`book_id` = `book`.`id`
                INNER JOIN `author` ON `author`.`id` = `book`.`author_id`
                WHERE `library`.`status` = :status && `book`.`title` LIKE :title";

        $result = $this->db->query($sql, ['status' => $status, 'title' => $title]);
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