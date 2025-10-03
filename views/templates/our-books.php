<?php
echo "<section>";
echo "<div class='container-fluid'>";
echo "<div class='row'>";
echo "<div class='col-sm-9'><h2 class='playfair-display-title-font'>Nos livres à l'échange</h2></div>";
echo "<div class='col-sm-3'><form method='post' action='index.php?action=search-book'><label for='booksearch'><img src='pictures/magnifying.png'></label><input type='search' placeholder='Rechercher un livre' name='booksearch'></form></div>";
echo "</div>";
echo "<div class='row'>";
foreach ($library as $book) {
    echo "<div class='col-sm-3 book-card'>";
    echo "<a href='?action=book-details&id=' " . $book->getId() . "'&userId='" . $book->getUser()->getUserId() . "'>";
    echo "<div class='book-img'>";
    echo "<img src='" . $book->getBookPicture() . "' alt='" . $book->getTitle() . "'>";
    echo "</div>";
    echo "<div class='book-info'>";
    echo "<h3>" . $book->getTitle() . "</h3>";
    echo "<span>" . $book->getAuthor()->getFirstname() . " " . $book->getAuthor()->getLastname() . "</span>";
    if(isset($_SESSION["user"]) && $_SESSION["user"] == $book->getUser()->getUserId()) {
        echo "<span class='italic'>Vendu par vous.</span>";
    }
    else{
        echo "<span class='italic'>Vendu par: " . $book->getUser()->getNickname() . "</span>";
    }
    echo "</div>";
    echo "</a>";
    echo "</div>";
}
echo "</div>";
echo "</div>";
echo "</section>";
?>

