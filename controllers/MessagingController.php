<?php

class MessagingController
{
    public function showMessages()
    {
        $view = new View('messagerie');
        $view->render("messagerie");
    }
}