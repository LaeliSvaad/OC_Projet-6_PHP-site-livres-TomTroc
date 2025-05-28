<?php
echo "<h2>Nos livres</h2>";

foreach ($library as $book) {

    echo"<br>";

    echo "<h2><a href='?action=detail-livre&id=" . $book->getId() . "' >" . $book->getTitle() . "</a></h2>";
    echo "Auteur : " . $book->getAuthor() . "<br>";
    echo "Vendu par : " . $book->getUser() . "<br>";

    echo"<br>";
}