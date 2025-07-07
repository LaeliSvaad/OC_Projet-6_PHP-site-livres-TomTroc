<?php
/**
 * Classe qui gère une conversation
 */
class ConversationManager extends AbstractEntityManager
{
    public function getConversation(int $user1Id, int $user2Id) : ?Conversation
    {
        $sql = "SELECT
                    `user`.`nickname`, 
                    `user`.`id` AS userId,
                    `user`.`picture`,
                    `message`.`text`, 
                    `message`.`date`, 
                    `message`.`seen_by_recipient`, 
                    `message`.`sender_id`,
                    `message`.`id`
                FROM `message`
                INNER JOIN `user` ON `user`.`id` = `message`.`sender_id`
                INNER JOIN `chat` ON `chat`.`user_1_id` = :user1Id AND `chat`.`user_2_id` = :user2Id";

        $result = $this->db->query($sql, ['user1Id' => $user1Id, 'user2Id' => $user2Id]);
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