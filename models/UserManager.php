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
        $sql = "SELECT `user`.`id`, `user`.`password` FROM `user` WHERE `nickname` = :nickname && `email` = :email";
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
    public function getUserById(int $id, ?int $idConnectedUser) : ?User
    {
        if(is_null($idConnectedUser))
        {
            $sql = "SELECT 
                    `user`.nickname, 
                    `user`.picture,
                    `user`.registration_date,
                    `user`.email,
                    `user`.id AS userId,
                    `library`.user_id,
                    `book`.title, 
                    `book`.id,
                    `book_data`.description, 
                    `book_data`.picture AS bookPicture, 
                    `author`.firstname, 
                    `author`.lastname, 
                    `author`.pseudo            
                FROM `user` 
                INNER JOIN `library` ON `library`.`user_id` = `user`.`id`
                INNER JOIN `book` ON `book`.`id` = `library`.`book_id`
                INNER JOIN `book_data` ON `book`.`id` = `book_data`.`book_id`
                INNER JOIN `author` ON `author`.`id` = `book`.`author_id`
                WHERE `user`.`id` = :id";

            $result = $this->db->query($sql, ['id' => $id]);
        }
        else
        {
            $sql = "SELECT 
                    `user`.nickname, 
                    `user`.picture,
                    `user`.registration_date,
                    `user`.email,
                    `user`.id AS userId,
                    `library`.user_id,
                    `book`.title, 
                    `book`.id,
                    `book_data`.description, 
                    `book_data`.picture AS bookPicture, 
                    `author`.firstname, 
                    `author`.lastname, 
                    `author`.pseudo,
                    `conversation`.id AS conversationId
                FROM `user`
                INNER JOIN `library` ON `library`.`user_id` = `user`.`id`
                INNER JOIN `book` ON `book`.`id` = `library`.`book_id`
                INNER JOIN `book_data` ON `book`.`id` = `book_data`.`book_id`
                INNER JOIN `author` ON `author`.`id` = `book`.`author_id`
                INNER JOIN conversation ON conversation.user_1_id = library.user_id AND conversation.user_2_id = :idConnectedUser 
                                       OR conversation.user_1_id = :idConnectedUser AND conversation.user_2_id = library.user_id
                WHERE `user`.`id` = :id";

            $result = $this->db->query($sql, ['id' => $id, 'idConnectedUser' => $idConnectedUser]);
        }

        $db_array = $result->fetchAll();
        $db_array[0]["registration_date"] = New Datetime($db_array[0]["registration_date"]);
        if (isset($db_array[0]["conversationId"])) {
            $chat = new Chat();
            $chat->addConversation(new Conversation($db_array[0]));
            $db_array[0]["chat"] = $chat;
        }
        $user = new User($db_array[0]);
        $library = new Library();

        foreach ($db_array as $element) {

            $element["author"] = new Author($element);
            $element["user"] = $user;
            $element["book"] = new Book($element);
            $library->addBook($element["book"]);

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