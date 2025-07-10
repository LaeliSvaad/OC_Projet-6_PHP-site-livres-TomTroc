<?php
echo "<h2>" . $book->getTitle() . "</h2>";
echo "<img class='book-img' src='" . $book->getBookPicture() . "' alt='" . $book->getTitle() . "'>";
echo "<p>Auteur: " . $book->getAuthor()->getFirstname() . " " . $book->getAuthor()->getLastname() . " " .  $book->getAuthor()->getPseudo() . "</p>";
echo "<p>Description: " . $book->getDescription() . "</p>";
if(isset($_SESSION["user"]) && $_SESSION["user"] == $book->getUser()->getUserId()){
    echo "<p>Vendu par vous</p>";
}
else{
    echo "<p>Vendu par : <a href='index.php?action=user-public-account&id=". $book->getUser()->getUserId() ."' >" . $book->getUser()->getNickname() . "</a> - ";
}
if(!isset($_SESSION["user"])){
    echo "Créez un compte ou connectez-vous pour lui envoyer un message.</p>";
}
else if(isset($_SESSION["user"]) && $_SESSION["user"] === $book->getUser()->getUserId()){
    echo"<a href='index.php?action=edit-book&bookId=" . $book->getId() . "'>Editer les détails de ce livre</a></p>";
}
else{
    echo "<a href='index.php?action=conversation&conversationId=" . $book->getUser()->getChat()->getChat()[0]->getConversationId() . "'>Lui envoyer un message</a></p>";
}


