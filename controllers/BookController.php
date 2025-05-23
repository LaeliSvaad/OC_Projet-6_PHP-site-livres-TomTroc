<?php


class BookController
{
    public function showBook() : void
    {
        $id = Utils::request("id", -1);
        $bookManager = new BookManager();
        $book = $bookManager->getBook($id);
        $view = new View('detail-livre');
        $view->render("detail-livre", ['book' => $book]);
    }
}