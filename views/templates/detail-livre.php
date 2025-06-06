<?php
echo "<h2>" . $book->getTitle() . "</h2>";
echo "<p>Auteur: " . $book->getAuthor()->getFirstname() . " " . $book->getAuthor()->getLastname() . " " .  $book->getAuthor()->getPseudo() . "</p>";
echo "<p>Description: " . $book->getDescription() . "</p>";
echo "<p>Vendu par :<a href='index.php?action=utilisateur&id=". $book->getUser()->getUserId() ."' >" . $book->getUser()->getNickname() . "</a> " . $book->getUser()->getEmail() . "</p>";