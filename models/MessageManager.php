<?php
/**
 * Classe qui gère un message
 */
class MessageManager extends AbstractEntityManager
{
    public function sendMessage(Message $message) : bool
    {
        $sql = "INSERT INTO `message` (`text`, `sender_id`, `seen_by_recipient`, `conversation_id`, `date`) VALUES (:text, :senderId, :seenByRecipient, :conversationId, NOW())";

        $result = $this->db->query($sql, [
            'text' => $message->getText(),
            'senderId' => $message->getSender()->getUserId(),
            'seenByRecipient' => (int)$message->getSeenByRecipient(),
            'conversationId' => $message->getConversationId()
        ]);

        return $result->rowCount() > 0;
    }

    public function updateMessageStatus(int $messageId) : bool
    {
        $sql = "UPDATE `message` SET `message`.`seen_by_recipient` = true WHERE `message`.`id` = :messageId";
        $result = $this->db->query($sql, [
            'messageId' => $messageId
        ]);
        return $result->rowCount() > 0;
    }
}