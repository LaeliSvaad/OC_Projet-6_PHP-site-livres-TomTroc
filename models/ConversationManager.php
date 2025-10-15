<?php
/**
 * Classe qui gère une conversation
 */
class ConversationManager extends AbstractEntityManager
{

    public function getConversationByUsersId(int $connectedUserId, int $interlocutorId) : ?Conversation
    {
        $sql = "SELECT
                    `user`.`nickname`, 
                    `user`.`picture`,
                    `user`.`id` AS userId,
                    `message`.`text`, 
                    `message`.`sender_id`,
                    `message`.`date` AS datetime,
                    `message`.`seen_by_recipient` AS seenByRecipient,
                    `message`.`id`,
                    `conversation`.`id` AS conversationId
                FROM `conversation`
                INNER JOIN `message` ON `message`.`conversation_id` = `conversation`.`id`
                INNER JOIN `user` ON `user`.`id` = `message`.`sender_id`
                WHERE `conversation`.`user_1_id` = :connectedUserId AND `conversation`.`user_2_id` = :interlocutorId
                OR `conversation`.`user_2_id` = :connectedUserId AND `conversation`.`user_1_id` = :interlocutorId";

        $result = $this->db->query($sql, ['connectedUserId' => $connectedUserId, 'interlocutorId' => $interlocutorId]);

        $db_array = $result->fetchAll();

        if ($db_array) {
            $conversation = new Conversation();
            $conversation->setConversationId($db_array[0]['conversationId']);
            foreach ($db_array as $element) {
                $element["datetime"] = new \DateTime($element["datetime"]);
                $element["sender"] = new User($element);
                $element["message"] = new Message($element);
                if($element["sender_id"] === $userId) {
                    $element["message"]->setIsConnectedUserMessage(true);
                }
                $conversation->addMessage($element["message"]);
            }
            return $conversation;

        }
        return null;
    }

    public function getConversationById(int $conversationId, int $userId) : ?Conversation
    {
        $sql = "SELECT
                    `user`.`nickname`, 
                    `user`.`picture`,
                    `user`.`id` AS userId,
                    `message`.`text`, 
                    `message`.`sender_id`,
                    `message`.`date` AS datetime,
                    `message`.`seen_by_recipient` AS seenByRecipient,
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

            foreach ($db_array as $element) {
                $element["datetime"] = new DateTime($element["datetime"]);
                $element["sender"] = new User($element);
                $element["message"] = new Message($element);
                if($element["sender_id"] != $userId) {
                    $conversation->setInterlocutor($element["sender"]);
                }
                else
                    $element["message"]->setConnectedUserMessage(true);
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
        $sql = "SELECT `id` FROM `conversation` WHERE `id` = LAST_INSERT_ID()";
        $result = $this->db->query($sql)->fetch();
        return $result['id'];
    }

}