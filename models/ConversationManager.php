<?php
/**
 * Classe qui gère une conversation
 */
class ConversationManager extends AbstractEntityManager
{
    public function getConversationByUsersId(int $user1Id, int $user2Id) : ?Conversation
    {
        $sql = "SELECT
                    `user`.`nickname`, 
                    `user`.`id` AS userId,
                    `message`.`text`, 
                    `message`.`sender_id`,
                    `message`.`date` AS datetime,
                    `message`.`id`,
                    `conversation`.`id` AS conversationId,
                    `conversation`.`user_1_id` AS user1Id,
                    `conversation`.`user_2_id` AS user2Id
                FROM `conversation`
                INNER JOIN `message` ON `message`.`conversation_id` = `conversation`.`id`
                INNER JOIN `user` ON `user`.`id` = `message`.`sender_id`
                WHERE `conversation`.`user_1_id` = :user1Id AND `conversation`.`user_2_id` = :user2Id
                OR `conversation`.`user_2_id` = :user1Id AND `conversation`.`user_1_id` = :user2Id";

        $result = $this->db->query($sql, ['user1Id' => $user1Id, 'user2Id' => $user2Id]);

        $db_array = $result->fetchAll();

        if ($db_array) {
            $conversation = new Conversation();
            $conversation->setConversationId($db_array[0]['conversationId']);
            $conversation->setUser1Id($db_array[0]["user1Id"]);
            $conversation->setUser2Id($db_array[0]["user2Id"]);
            foreach ($db_array as $element) {
                $element["datetime"] = new DateTime($element["datetime"]);
                $element["sender"] = new User($element);
                $element["message"] = new Message($element);
                $conversation->addMessage($element["message"]);
            }
            return $conversation;
        }
        return null;
    }

    public function getConversationById(int $conversationId) : ?Conversation
    {
        $sql = "SELECT
                    `user`.`nickname`, 
                    `user`.`id` AS userId,
                    `message`.`text`, 
                    `message`.`sender_id`,
                    `message`.`date` AS datetime,
                    `message`.`id`,
                    `conversation`.`user_1_id` AS user1Id,
                    `conversation`.`user_2_id` AS user2Id
                FROM `conversation`
                INNER JOIN `message` ON `message`.`conversation_id` = `conversation`.`id`
                INNER JOIN `user` ON `user`.`id` = `message`.`sender_id`
                WHERE `conversation`.`id` = :conversationId";

        $result = $this->db->query($sql, ['conversationId' => $conversationId]);

        $db_array = $result->fetchAll();

        if ($db_array) {
            $conversation = new Conversation();
            $conversation->setConversationId($conversationId);
            $conversation->setUser1Id($db_array[0]["user1Id"]);
            $conversation->setUser2Id($db_array[0]["user2Id"]);
            foreach ($db_array as $element) {
                $element["datetime"] = new DateTime($element["datetime"]);
                $element["sender"] = new User($element);
                $element["message"] = new Message($element);
                $conversation->addMessage($element["message"]);
            }
            return $conversation;
        }
        return null;
    }

    public function addConversation(Conversation $conversation) : bool
    {
        $sql = "INSERT INTO `conversation` (`user_1_id`, `user_2_id`) VALUES (:user1Id, :user2Id)";

        $result = $this->db->query($sql, [
            'user1Id' => $conversation->getUser1Id(),
            'user2Id' => $conversation->getUser2Id(),
        ]);

        return $result->rowCount() > 0;
    }

    public function getLastConversationId() : int
    {
        $sql = "SELECT `id` FROM `conversation` WHERE id = LAST_INSERT_ID()";
        $result = $this->db->query($sql)->fetch();
        return $result['id'];
    }
}