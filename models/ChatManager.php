<?php
/**
 * Classe qui gère une conversation
 */
class ChatManager extends AbstractEntityManager
{
    public function checkExistingChat() : int
    {
        return $chatId;
    }

    public function getChatById(int $id) : Chat
    {

        return $chat;
    }

    public function sendMessage() : Message
    {
        return $message;
    }


}