<?php

class HomeController
{
    public function showHome(): void
    {
        $libraryManager = new LibraryManager();
        $library = $libraryManager->getHomepageBooks();
        $view = new View('home');
        $view->render("home", ['library' => $library->getLibrary()]);
    }

}