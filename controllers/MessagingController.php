<?php

class MessagingController
{
    public function showConversation() : void
    {
        $conversationId = Utils::request("conversationId", -1);
        $conversationManager = new ConversationManager();
        $conversation = $conversationManager->getConversation($conversationId);
        $view = new View('messagerie');
        $view->render("messagerie", ['conversation' => $conversation]);
    }

    public function showChat() : void
    {
        $userId = $_SESSION["user"];
        $chatManager = new ChatManager();
        $chat = $chatManager->getChat($userId);
        $view = new View('chat');
        $view->render("chat", ['chat' => $chat]);
    }

    public function contactUser() : void
    {
        $connectedUserId = $_SESSION["user"];
        $userId = Utils::request("userId", -1);
        $conversationManager = new ConversationManager();
        $conversation = $conversationManager->getConversationFromBookPage($connectedUserId, $userId);
        if(is_null($conversation))
        {
            $conversation = new Conversation();
            $conversation->setUser1Id($connectedUserId);
            $conversation->setUser2Id($userId);
            $view = new View('messagerie');
            $view->render("messagerie", ['conversation' => $conversation]);
        }
        else
        {
            $view = new View('messagerie');
            $view->render("messagerie", ['conversation' => $conversation]);
        }
    }
}