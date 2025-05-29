<?php

class LibraryController
{
    public function showLibrary() : void
    {

        $id = Utils::request("id", -1);

        $libraryManager = new LibraryManager();
        var_dump(BookStatus::AVAILABLE);
        $library = $libraryManager->getAvailableBooks();

        $view = new View('nos-livres');
        $view->render("nos-livres", ['library' => $library->getLibrary()] );
    }
}