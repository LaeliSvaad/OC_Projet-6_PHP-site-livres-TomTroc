<?php
echo "<h2>" . $book->getTitle() . "</h2>";
echo "<img class='book-img' src='" . $book->getBookPicture() . "' alt='" . $book->getTitle() . "'>";
echo "<p>Auteur: " . $book->getAuthor()->getFirstname() . " " . $book->getAuthor()->getLastname() . " " .  $book->getAuthor()->getPseudo() . "</p>";
echo "<p>Description: " . $book->getDescription() . "</p>";
echo "<p>Vendu par : <a href='index.php?action=conversation&id=". $book->getUser()->getUserId() ."' >" . $book->getUser()->getNickname() . "</a> -  ";
if(isset($_SESSION["user"]))
    echo "<a href='index.php?action=conversation&conversationId=" . $book->getUser()->getConversation()->getConversationId()  . "'>Lui envoyer un message</a></p>";
else
    echo "Créez un compte ou connectez-vous pour lui envoyer un message.</p>";