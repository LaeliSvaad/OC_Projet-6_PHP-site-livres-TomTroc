<?php

/**
 * Classe qui gère les utilisateurs
 */
class UserManager extends AbstractEntityManager
{
    public function addUser(User $user): ?int
    {
        $sql = "INSERT INTO `user` (`nickname`, `email`, `password`, `picture`, `registration_date`) VALUES (:nickname, :email, :password, :picture, NOW())";
        $result = $this->db->query($sql, [
            'nickname' => $user->getNickname(),
            'password' => $user->getPassword(),
            'picture' => $user->getPicture  (),
            'email' => $user->getEmail()
        ]);
        return $result->rowCount() > 0;
    }

    /**
     * Modifie les données d'un utilisateur.
     * @param User $user
     * @return ?int
     */
    public function modifyUser(User $user): ?int
    {
        $sql = "UPDATE `user` SET `nickname`, `email`, `password`, `picture`) WHERE `id` = :id";
        $result = $this->db->query($sql, [
            'nickname' => $user->getNickname(),
            'password' => $user->getPassword(),
            'email' => $user->getEmail(),
            'picture' => $user->getPicture(),
            'id' => $user->getId()
        ]);
        return $result->rowCount() > 0;
    }

    /**
     * Récupère un user par son login et email en vue de la connexion.
     * @param string $nickname
     * @param string $email
     * @return ?User
     */
    public function getUser(string $nickname, string $email) : ?User
    {
        $sql = "SELECT * FROM `user` WHERE `nickname` = :nickname && `email` = :email";
        $result = $this->db->query($sql, ['nickname' => $nickname, 'email' => $email]);
        $user = $result->fetch();
        if ($user) {
            return new User($user);
        }
        return null;
    }


    /**
     * Récupère un utilisateur par son id.
     * @param int $id
     * @return ?User
     */
    public function getUserById(int $id) : ?User
    {
        $sql = "SELECT 
                    `user`.nickname, 
                    `user`.picture,
                    `user`.id AS userId,
                    `author`.firstname, 
                    `author`.lastname, 
                    `author`.pseudo,
                    `book`.title, 
                    `book`.description, 
                    `book`.picture AS bookPicture, 
                    `book`.id
                FROM `user` 
                INNER JOIN `library` ON `library`.`user_id` = `user`.`id`
                INNER JOIN `book` ON `book`.`id` = `library`.`book_id`
                INNER JOIN `author` ON `author`.`id` = `book`.`author_id`
                WHERE `user`.`id` = :id";

        $result = $this->db->query($sql, ['id' => $id]);

        $db_array = $result->fetchAll();

        $library = new Library();


        foreach ($db_array as $element) {

            $element["author"] = new Author($element);
            $user = new User($element);
            $book = new Book($element);
            $library->addBook($book);
        }

        $user->setLibrary($library);
        return $user;
    }

    public function checkExistingEmail(string $email) :int
    {
        $sql = "SELECT COUNT(*) FROM `user` WHERE `email` = :email";
        $result = $this->db->query($sql, ['email' => $email]);
        $user = $result->fetch();
        return $user["COUNT(*)"];
    }
}