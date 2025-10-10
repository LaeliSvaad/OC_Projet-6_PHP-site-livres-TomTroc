<?php

class ChatManager extends AbstractEntityManager
{
    public function getChat(int $userId) : ?Chat
    {
       $sql = "SELECT
                    `conversation`.`id` AS conversationId,
                    `message`.`id`,  
                    `user`.`nickname`,
                    `user`.`picture`,
                    `user`.`id` AS userId,
                    `message`.`text`,
                    `message`.`date` AS `datetime`
                FROM `conversation`
                JOIN (
                    SELECT `message`.`conversation_id`, MAX(`date`) AS latest_sent
                    FROM `message`
                    GROUP BY `message`.`conversation_id`
                ) lastmessages ON `conversation`.`id` = lastmessages.`conversation_id`
                JOIN `message` ON `message`.`conversation_id` = `lastmessages`.`conversation_id` AND `message`.`date` = lastmessages.latest_sent
                JOIN `user`  ON `message`.`sender_id` = `user`.`id`
                WHERE `conversation`.`user_1_id` = :userId OR `conversation`.`user_2_id` = :userId
                ORDER BY `message`.`date` DESC";

        $result = $this->db->query($sql, ['userId' => $userId]);

        if(is_null($result))
            return null;
        else
        {
            $chat = new Chat();
            foreach ($result as $element) {
                $element["sender"] = new User($element);
                $element["datetime"] = new Datetime($element["datetime"]);
                $element["message"] = new Message($element);
                $element["conversation"] = new Conversation($element);
                if($element["conversation"]->getInterlocutor() === NULL && $element["sender"]->getUserId() != $userId){
                    echo"<br><br>gggg<br><br>";
                    $element["conversation"]->setInterlocutor($element["sender"]);
                    var_dump($element["conversation"]->getInterlocutor());
                    echo"<br><br>";
                }
                else if($element["conversation"]->getConnectedUser() === NULL && $element["sender"]->getUserId() === $userId){
                    echo"<br><br>hhhh<br><br>";
                    $element["conversation"]->setConnectedUser($element["sender"]);
                    var_dump($element["conversation"]->getConnectedUser());
                    echo"<br><br>";
                }

                $element["conversation"]->addMessage($element["message"]);
                $chat->addConversation($element["conversation"]);
            }
            return $chat;
        }
    }
}