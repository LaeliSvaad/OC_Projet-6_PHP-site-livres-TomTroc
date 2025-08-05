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

    public function deleteBook() : void
    {
        $libraryManager = new LibraryManager();
        $id = Utils::request('id', '-1');

        if($libraryManager->deleteBook($id) > 0)
            Utils::redirect("user-private-account");
        else{
            throw new Exception("Une erreur est survenue lors de la suppression du livre.");
        }
    }
}