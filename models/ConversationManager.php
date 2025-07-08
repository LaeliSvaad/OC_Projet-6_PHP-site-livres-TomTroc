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
                    `message`.`id`,
                    `chat`.id
                FROM `chat`
                INNER JOIN `message` ON `message`.`conversation_id` = `chat`.`id`
                INNER JOIN `user` ON `user`.`id` = `message`.`sender_id`
                WHERE `chat`.`id` = :conversationId";

        $result = $this->db->query($sql, ['conversationId' => $conversationId]);

        $conversation = new Conversation();
        foreach ($result as $element) {
            $element["sender"] = new User($element);
            $element["message"] = new Message($element);
            $conversation->addMessage($element["message"]);
        }
        return $conversation;

    }

    public function sendMessage() : Message
    {
        return $message;
    }
}