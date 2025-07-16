<?php

/**
 * Classe qui gère les utilisateurs
 */
class UserManager extends AbstractEntityManager
{
    /**
     * Vérifie l'existence ou non d'un compte avec l'adresse email fournie.
     * @param string $email
     * @return int
     */
    public function checkExistingEmail(string $email) :int
    {
        $sql = "SELECT COUNT(*) FROM `user` WHERE `email` = :email";
        $result = $this->db->query($sql, ['email' => $email]);
        $user = $result->fetch();
        return $user["COUNT(*)"];
    }

    /**
     * Ajoute un utilisateur en base de données.
     * @param User $user
     * @return ?int
     */

    public function addUser(User $user): ?int
    {
        $sql = "INSERT INTO `user` (`nickname`, `email`, `password`, `registration_date`) VALUES (:nickname, :email, :password, NOW())";
        $result = $this->db->query($sql, [
            'nickname' => $user->getNickname(),
            'password' => $user->getPassword(),
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
    public function getUserByLoginInfo(string $nickname, string $email) : ?User
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
     * Récupère un profil public d'utilisateur par son id.
     * @param int $id
     * @return ?User
     */
    public function getPublicUserById(int $userId) : ?User
    {
        $sql = "SELECT `user`.`nickname`, `user`.`picture`, `user`.`registration_date`, `user`.`id` AS user_id FROM `user` WHERE `id` = :userId";
        $result = $this->db->query($sql, ['userId' => $userId]);
        $user = $result->fetch();
        $user["registration_date"] = new DateTime($user["registration_date"]);
        if ($user) {
            return new User($user);
        }
        return null;
    }

    /**
     * Récupère les infos de l'utilisateur connecté grâce à son id.
     * @param int $id
     * @return ?User
     */
    public function getPrivateUserById(int $userId) : ?User
    {
        $sql = "SELECT `user`.`nickname`, `user`.`picture`, `user`.`registration_date`, `user`.`email`, `user`.`id` AS user_id FROM `user` WHERE `id` = :userId";
        $result = $this->db->query($sql, ['userId' => $userId]);
        $user = $result->fetch();
        $user["registration_date"] = new DateTime($user["registration_date"]);
        if ($user) {
            return new User($user);
        }
        return null;
    }

}