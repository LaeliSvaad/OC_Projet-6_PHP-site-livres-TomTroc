<?php

/**
 * Classe qui gère le détail des livres.
 */
class BookManager extends AbstractEntityManager
{
    public function getBook(int $id) : ?Book
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
}