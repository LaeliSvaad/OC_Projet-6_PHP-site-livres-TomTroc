<?php

/**
 * Classe qui gère les auteurs.
 */
class AuthorManager extends AbstractEntityManager
{
    public function getAuthor(int $id) : ?Author
    {
        $sql = "SELECT * FROM author WHERE id = :id";
        $result = $this->db->query($sql, ['id' => $id]);
        $author = $result->fetch();
        if ($author) {
            return new Author($author);
        }
        return null;
    }
}