<?php

/**
 * Classe qui gère le détail des livres.
 */
class BookManager extends AbstractEntityManager
{

    public function getBook(int $id, int $userId) : ?Book
    {
        $sql = "SELECT book.`title`, book.id,
                book_data.`description`, book_data.`picture` AS bookPicture,
                author.`firstname`, author.lastname, author.pseudo, 
                user.`nickname`, user.`email`, user.`id` AS userId
                FROM book 
                INNER JOIN book_data ON book.`id` = book_data.book_id
                INNER JOIN author ON book.`author_id` = author.id 
                INNER JOIN library ON book.`id` = library.book_id
                INNER JOIN user ON library.`user_id` = user.id
                WHERE book.`id` = :id AND library.user_id = :userId";

        $result = $this->db->query($sql, ['id' => $id, 'userId' => $userId]);

        $db_array = $result->fetch();

        if ($db_array) {
            $db_array["author"] = new Author($db_array);
            $db_array["user"] = new User($db_array);
            return new Book($db_array);
        }

        return null;
    }

    public function addBook(Book $book) : ?int
    {
        $sql = "SELECT * FROM book 
                INNER JOIN author ON book.author_id = author.id 
                INNER JOIN library ON book.id = library.book_id
                INNER JOIN user ON library.user_id = user.id
                WHERE book.id = :id";

        $result = $this->db->query($sql, ['id' => $id]);
        $db_array = $result->fetch();

        if ($db_array) {
            $db_array["author"] = new Author($db_array);
            $db_array["user"] = new User($db_array);
            return new Book($db_array);
        }
        return null;
    }

    public function modifyBook(Book $book) : ?int
    {
        $sql = "UPDATE `book` SET `title` = :title, `description` = :description, `picture` = :picture WHERE `id` = :id";
        $result = $this->db->query($sql, [
            'title' => $book->getTitle(),
            'description' => $book->getDescription(),
            'picture' => $book->getPicture(),
            'id' => $book->getId()
        ]);
        return $result->rowCount() > 0;
    }
}