<?php

class LibraryController
{
    public function showLibrary() : void
    {
        $libraryManager = new LibraryManager();
        $library = $libraryManager->getAvailableBooks();

        $view = new View('nos-livres');
        $view->render("nos-livres", ['library' => $library->getLibrary()] );
    }

    public function showSearchResults() : void
    {
        $booksearch = Utils::request("booksearch", NULL);
        $booksearch = Utils::controlUserInput($booksearch);

        $libraryManager = new LibraryManager();
        $library = $libraryManager->getBooksByTitle($booksearch);

        $view = new View('nos-livres');
        $view->render("nos-livres", ['library' => $library->getLibrary()] );
    }
}