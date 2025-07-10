<?php


class BookController
{
    public function showBook() : void
    {
        if(isset($_SESSION['user']))
            $idConnectedUser = $_SESSION['user'];
        else
            $idConnectedUser = null;
        $id = Utils::request("id", -1);
        $userId = Utils::request("userId", -1);
        $bookManager = new BookManager();
        $book = $bookManager->getBook($id, $userId, $idConnectedUser);
        $view = new View('detail-livre');
        $view->render("detail-livre", ['book' => $book]);
    }

    public function editBook() : void
    {
        $view = new View('detail-livre');
        $view->render("detail-livre", ['book' => $book]);
    }
}