<?php
/**
 * Classe qui gère une conversation
 */
class ConversationManager extends AbstractEntityManager
{
    public function getConversation(int $conversationId) : ?Conversation
    {
        $sql = "SELECT
                    `user`.`nickname`, 
                    `user`.`id` AS userId,
                    `message`.`text`, 
                    `message`.`sender_id`,
                    `message`.`date` AS datetime,
                    `message`.`id`,
                    `chat`.id AS conversationId
                FROM `chat`
                INNER JOIN `message` ON `message`.`conversation_id` = `chat`.`id`
                INNER JOIN `user` ON `user`.`id` = `message`.`sender_id`
                WHERE `chat`.`id` = :conversationId";

        $result = $this->db->query($sql, ['conversationId' => $conversationId]);

        $result_array = $result->fetchAll();

        if ($result_array) {
            $conversation = new Conversation();
            foreach ($result_array as $element) {
                $element["datetime"] = new DateTime($element["datetime"]);
                $element["sender"] = new User($element);
                $element["message"] = new Message($element);
                $conversation->addMessage($element["message"]);
            }
            return $conversation;
        }
        return null;
    }

    public function getConversationFromBookPage(int $connectedUserId, int $userId) : ?Conversation
    {
        $sql = "SELECT
                    `user`.`nickname`, 
                    `user`.`id` AS userId,
                    `message`.`text`, 
                    `message`.`sender_id`,
                    `message`.`date` AS datetime,
                    `message`.`id`,
                    `chat`.id AS conversationId
                FROM `chat`
                INNER JOIN `message` ON `message`.`conversation_id` = `chat`.`id`
                INNER JOIN `user` ON `user`.`id` = `message`.`sender_id`
                WHERE `chat`.`user_1_id` = :userId AND `chat`.`user_2_id` = :connectedUserId 
                OR `chat`.`user_1_id` = :connectedUserId AND `chat`.`user_2_id` = :userId";

        $result = $this->db->query($sql, ['connectedUserId' => $connectedUserId, 'userId' => $userId]);

        $result_array = $result->fetchAll();

        if ($result_array) {
            $conversation = new Conversation();
            foreach ($result_array as $element) {
                $element["datetime"] = new DateTime($element["datetime"]);
                $element["sender"] = new User($element);
                $element["message"] = new Message($element);
                $conversation->addMessage($element["message"]);
            }
            return $conversation;
        }
        return null;
    }

}