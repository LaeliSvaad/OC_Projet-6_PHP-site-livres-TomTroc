<?php
echo "<h2>Nos livres à l'échange</h2>";
echo "<section>";
echo "<form method='post' action='index.php?action=search-book'><div class='book-searchbar'><img src='pictures/magnifying.png'><input type='search' placeholder='Rechercher un livre' name='booksearch'></div></form>";
echo "<div class='books'>";
foreach ($library as $book) {
    echo "<div class='book'>";
    echo "<h2><a href='?action=detail-livre&id=" . $book->getId() . "' >" . $book->getTitle() . "</a></h2>";
    echo "<img class='book-img' src='" . $book->getBookPicture() . "' alt='" . $book->getTitle() . "'>";
    echo "<div>Auteur : " . $book->getAuthor()->getFirstname() . " " . $book->getAuthor()->getLastname() . " " .  $book->getAuthor()->getPseudo() . "</div>";
    echo "<div>Vendu par : <a href='index.php?action=user-account&id=" . $book->getUser()->getUserId() . "'>" . $book->getUser()->getNickname() . "</a></div>";
    echo "</div>";
}
echo "</div>";
echo "</section>";