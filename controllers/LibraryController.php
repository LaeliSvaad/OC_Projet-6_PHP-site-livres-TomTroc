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
}