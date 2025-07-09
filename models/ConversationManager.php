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
                    `chat`.id AS conversationId,
                    `chat`.`user_1_id` AS user1Id,
                    `chat`.`user_2_id` AS user2Id
                FROM `chat`
                INNER JOIN `message` ON `message`.`conversation_id` = `chat`.`id`
                INNER JOIN `user` ON `user`.`id` = `message`.`sender_id`
                WHERE `chat`.`id` = :conversationId";

        $result = $this->db->query($sql, ['conversationId' => $conversationId]);

        $db_array = $result->fetchAll();

        if ($db_array) {
            $conversation = new Conversation();
            var_dump($db_array);
            $conversation->setId($db_array[0]["conversationId"]);
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
}