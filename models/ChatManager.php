<?php

class ChatManager extends AbstractEntityManager
{
    /*public function getChat(int $userId) : ?Chat
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
                echo"var_dump d'element: "; var_dump($element);
                   if($element["conversation"] ->getInterlocutor() === NULL && $element["sender"]->getUserId() !== $userId){
                    echo"<br><br>";
                    echo"ici<br><br>";
                    $element["conversation"]->setInterlocutor($element["sender"]);
                    echo $element["conversation"]->getInterlocutor()->getNickname();
                    echo"<br><br>";
                }
                else if($element["conversation"]->getConnectedUser() === NULL && $element["sender"]->getUserId() === $userId){
                    echo"la<br><br>";
                    $element["conversation"]->setConnectedUser($element["sender"]);
                    echo $element["conversation"]->getConnectedUser()->getNickname();
                    echo"<br><br>";
                }
                $element["conversation"]->addMessage($element["message"]);
                $chat->addConversation($element["conversation"]);
            }
            return $chat;
        }
    }*/

    public function getChat(int $connectedUserId): ?Chat
    {
        $sql = "SELECT
                    `conversation`.`user_1_id`,
                    `conversation`.`user_2_id`,
                    `conversation`.`id` AS conversationId,
                    `message`.`text`,
                    `message`.`seen_by_recipient`,
                    `message`.`id`,
                    `user`.`picture`,
                    `user`.`id` as userId
                FROM `conversation`
                 JOIN (
                    SELECT `message`.`conversation_id`, MAX(`date`) AS latest_sent
                    FROM `message`
                    GROUP BY `message`.`conversation_id`
                ) lastmessages ON `conversation`.`id` = lastmessages.`conversation_id`
                JOIN `message` ON `message`.`conversation_id` = `lastmessages`.`conversation_id` AND `message`.`date` = lastmessages.latest_sent
                JOIN `user`  ON `message`.`sender_id` = `user`.`id`
                WHERE `conversation`.`user_1_id` = :userId OR `conversation`.`user_2_id` = :userId";
//il faudrait parvenir à sélectionner dans la table l'user_id différent de connected user id où user_id_1 ou user_id_2 est égal à connected user id. Puis faire un join sur user pour trouver l'interlocuteur
        $result = $this->db->query($sql, ['userId' => $connectedUserId]);

        if(is_null($result))
            return null;
        else
        {
            $chat = new Chat();
            foreach ($result as $element) {
                $sender = new User($element);
                /*$interlocutor = new User($element);*/
                $message = new Message($element);
                $message->setSender($sender);
                $conversation = new Conversation();
                $conversation->addMessage($message);
                /*$conversation->setInterlocutor($interlocutor);*/
                $conversation->setConversationId($element['conversationId']);
                $chat->addConversation($conversation);
            }
            return $chat;
        }

    }
}