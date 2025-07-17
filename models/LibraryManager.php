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
                    `book`.id,
                    `book_data`.description, 
                    `book_data`.picture AS bookPicture, 
                    `author`.firstname, 
                    `author`.lastname, 
                    `author`.pseudo
                FROM `library`
                INNER JOIN `user` ON `user`.`id` = `library`.`user_id`
                INNER JOIN `book` ON `library`.`book_id` = `book`.`id`
                INNER JOIN `book_data` ON `book_data`.`book_id` = `book`.`id`
                INNER JOIN `author` ON `author`.`id` = `book`.`author_id`
                WHERE `book_data`.`status` = :status LIMIT 4";
        }
        else
        {
            $sql = "SELECT
                    `user`.nickname, 
                    `user`.id AS userId,
                    `book`.title, 
                    `book`.id,
                    `book_data`.description, 
                    `book_data`.picture AS bookPicture, 
                    `author`.firstname, 
                    `author`.lastname, 
                    `author`.pseudo
                FROM `library`
                INNER JOIN `user` ON `user`.`id` = `library`.`user_id`
                INNER JOIN `book` ON `library`.`book_id` = `book`.`id`
                INNER JOIN `book_data` ON `book_data`.`book_id` = `book`.`id`
                INNER JOIN `author` ON `author`.`id` = `book`.`author_id`
                WHERE `book_data`.`status` = :status";
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
                    `book`.id,
                    `book_data`.description, 
                    `book_data`.picture AS bookPicture, 
                    `author`.firstname, 
                    `author`.lastname, 
                    `author`.pseudo
                FROM `library`
                INNER JOIN `user` ON `user`.`id` = `library`.`user_id`
                INNER JOIN `book` ON `library`.`book_id` = `book`.`id`
                INNER JOIN `book_data` ON `book_data`.`book_id` = `book`.`id`
                INNER JOIN `author` ON `author`.`id` = `book`.`author_id`
                WHERE `book_data`.`status` = :status && `book`.`title` LIKE :title";

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

    public function getLibraryByUserId(int $userId): ?Library
    {
        $sql = "SELECT
                    `book`.title, 
                    `book`.id,
                    `book_data`.description, 
                    `book_data`.picture AS bookPicture, 
                    `author`.firstname, 
                    `author`.lastname, 
                    `author`.pseudo
                FROM `library`
                INNER JOIN `book` ON `library`.`book_id` = `book`.`id`
                INNER JOIN `book_data` ON `book_data`.`book_id` = `book`.`id`
                INNER JOIN `author` ON `author`.`id` = `book`.`author_id`
                WHERE `library`.`user_id` = :userId";

        $result = $this->db->query($sql, ['userId' => $userId]);

        if(is_null($result))
        {
            return null;
        }
        else
        {
            $library = new Library();
            foreach ($result as $element)
            {
                $element["author"] = new Author($element);
                $element["user"] = new User($element);

                $book = new Book($element);
                $library->addBook($book);
            }

            return $library;
        }
    }

}