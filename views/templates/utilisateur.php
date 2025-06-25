<?php
echo $user->getNickname();
echo"<br>";
echo $user->getEmail();
echo"<br>";
echo "<img src='" . $user->getPicture() . "' alt='photo de profil de " . $user->getNickname() . "'/>";
echo"<div>";
$library = $user->getLibrary()->getLibrary();

foreach ($library as $book) {
    echo "<div class='book'>";
    echo "<h2><a href='?action=detail-livre&id=" . $book->getId() . "' >" . $book->getTitle() . "</a></h2>";
    echo "<img class='book-img' src='" . $book->getBookPicture() . "' alt='" . $book->getTitle() . "'>";
    echo "<div>Auteur : " . $book->getAuthor()->getFirstname() . " " . $book->getAuthor()->getLastname() . " " .  $book->getAuthor()->getPseudo() . "</div>";
    echo "</div>";
}
echo "</div>";

