<?php
echo "<h2>" . $book->getTitle() . "</h2>";
echo "<p>Auteur: " . $book->getAuthor() . "</p>";
echo "<p>Description: " . $book->getDescription() . "</p>";
echo "<p>Vendu par :" . $book->getUser() . "</p>";