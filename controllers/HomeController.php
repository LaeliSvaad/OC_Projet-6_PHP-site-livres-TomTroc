<?php

class HomeController
{
    public function showHome(): void
    {
        $libraryManager = new LibraryManager();
        $library = $libraryManager->getAvailableBooks();
        $view = new View('home');
        $view->render("home", ['library' => $library->getLibrary()]);
    }

}