<?php

class MessagingController
{
    public function showConversation() : void
    {
        $user1Id = Utils::request("user1Id", -1);
        $user2Id = Utils::request("user2Id", -1);
        $conversationId = Utils::request("conversationId", -1);
        $conversationManager = new ConversationManager();
        if($user1Id != -1 && $user2Id != -1)
            $conversation = $conversationManager->getConversationByUsersId($user1Id, $user2Id);
        else
            $conversation = $conversationManager->getConversationById($conversationId);
        $view = new View('conversation');
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