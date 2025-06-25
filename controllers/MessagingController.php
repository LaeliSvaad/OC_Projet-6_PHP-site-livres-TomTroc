<?php

class MessagingController
{
    public function showMessages() : void
    {
        $id = Utils::request("id", -1);
        $chatManager = new ChatManager();
        $chat = $chatManager->getChatById($id);
        $view = new View('messagerie');
        $view->render("messagerie", ['chat' => $chat]);
    }

    public function showMessagingPage() : void
    {

    }
}