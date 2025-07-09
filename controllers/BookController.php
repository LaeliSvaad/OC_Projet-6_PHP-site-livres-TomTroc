<?php


class BookController
{
    public function showBook() : void
    {
        if (isset($_SESSION['user']))
            $idConnectedUser = $_SESSION['user'];
        else
            $idConnectedUser = null;
        $id = Utils::request("id", -1);
        $bookManager = new BookManager();
        $book = $bookManager->getBook($id, $idConnectedUser);
        $view = new View('detail-livre');
        $view->render("detail-livre", ['book' => $book]);
    }
}