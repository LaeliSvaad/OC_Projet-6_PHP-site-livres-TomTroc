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
}