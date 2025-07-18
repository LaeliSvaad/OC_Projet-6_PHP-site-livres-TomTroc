<?php

class LibraryController
{
    public function showLibrary() : void
    {
        $libraryManager = new LibraryManager();
        $action = Utils::request('action', 'home');
        if($action == "home")
            $library = $libraryManager->getHomepageBooks();
        else
            $library = $libraryManager->getAvailableBooks();

        $view = new View('our-books');
        $view->render("our-books", ['library' => $library->getLibrary()] );
    }

    public function showSearchResults() : void
    {
        $booksearch = Utils::request("booksearch", NULL);
        $booksearch = Utils::controlUserInput($booksearch);

        $libraryManager = new LibraryManager();
        $library = $libraryManager->getBooksByTitle($booksearch);

        $view = new View('our-books');
        $view->render("our-books", ['library' => $library->getLibrary()] );
    }
}