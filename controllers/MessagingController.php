<?php

class MessagingController
{
    public function showMessages() : void
    {
        $id = Utils::request("id", -1);
        $conversationManager = new ConversationManager();
        $conversation = $conversationManager->getConversation(3, 4);
        $view = new View('messagerie');
        $view->render("messagerie", ['conversation' => $conversation]);
    }

    public function showMessagingPage() : void
    {

    }
}