<?php

class MessagingController
{
    public function showConversation() : void
    {
        $conversationId = Utils::request("conversationId", -1);
        $conversationManager = new ConversationManager();
        $view = new View('conversation');
        $conversation = $conversationManager->getConversation($conversationId);
        $view->render("conversation", ['conversation' => $conversation]);

    }

    public function showChat() : void
    {
        $userId = $_SESSION["user"];
        $chatManager = new ChatManager();
        $chat = $chatManager->getChat($userId);
        $view = new View('chat');
        $view->render("chat", ['chat' => $chat]);
    }

    public function sendMessage() : void
    {
        $connectedUserId = $_SESSION["user"];


    }
}