<?php
echo "<h2>Nos livres</h2>";

foreach ($library as $book) {
    echo"<br>";
    echo "<h2><a href='?action=detail-livre&id=" . $book->getId() . "' >" . $book->getTitle() . "</a></h2>";
    echo "Auteur : " . $book->getAuthor()->getFirstname() . " " . $book->getAuthor()->getLastname() . " " .  $book->getAuthor()->getPseudo() . "<br>";
    echo "Vendu par : <a href='index.php?action=utilisateur&id=" . $book->getUser()->getUserId() . "'>" . $book->getUser()->getNickname() . "</a><br>";
    echo"<br>";
}