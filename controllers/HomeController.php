<?php

class HomeController
{
    public function showHome(): void
    {
        $view = new View('home');
        $view->render("home");
    }

}