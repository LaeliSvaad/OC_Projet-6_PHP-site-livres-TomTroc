<?php

/**
 * Classe qui gère le détail des livres.
 */
class BookManager extends AbstractEntityManager
{
    public function getBook(int $id, ?int $idConnectedUser) : ?Book
    {
        if(is_null($idConnectedUser)) {
            $sql = "SELECT book.`title`, book.`description`, book.`picture` AS bookPicture, 
                author.`firstname`, author.lastname, author.pseudo, 
                user.`nickname`, user.`email`, user.`id` AS userId
                FROM book 
                INNER JOIN author ON book.`author_id` = author.id 
                INNER JOIN library ON book.`id` = library.book_id
                INNER JOIN user ON library.`user_id` = user.id
                WHERE book.`id` = :id";

            $result = $this->db->query($sql, ['id' => $id]);

            $db_array = $result->fetch();
            if ($db_array) {
                $db_array["author"] = new Author($db_array);
                $db_array["user"] = new User($db_array);
                return new Book($db_array);
            }
        }
        else{
            $sql = "SELECT book.`title`, book.`description`, book.`picture` AS bookPicture, 
                author.`firstname`, author.lastname, author.pseudo, 
                user.`nickname`, user.`email`, user.`id` AS userId,
                `chat`.`id` AS conversationId
                FROM book 
                INNER JOIN author ON book.`author_id` = author.id 
                INNER JOIN library ON book.`id` = library.book_id
                INNER JOIN user ON library.`user_id` = user.id
                INNER JOIN chat ON chat.user_1_id = library.user_id AND chat.user_2_id = :idConnectedUser 
                                       OR chat.user_1_id = :idConnectedUser AND chat.user_2_id = library.user_id
                WHERE book.`id` = :id";

            $result = $this->db->query($sql, ['id' => $id,  'idConnectedUser' => $idConnectedUser]);

            $db_array = $result->fetch();
            if ($db_array) {
                $db_array["author"] = new Author($db_array);
                $db_array["conversation"] = new Conversation($db_array);
                $db_array["user"] = new User($db_array);
                return new Book($db_array);
            }
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