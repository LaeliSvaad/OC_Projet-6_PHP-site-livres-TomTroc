<section>
    <div class="main-content-row">
        <div class="content-block">
            <div class="profile-picture">
                <img src="<?= $user->getPicture() ?>" alt="<?= $user->getNickname() ?> profile picture" />
            </div>
        </div>
        <div class="content-block">
            <h2><?= $user->getNickname() ?></h2>
            <span>Membre depuis <?= Utils::dateInterval($user->getRegistrationDate()) ?></span>
            <span>Bibliothèque</span>
            <span>livres</span>
            <?php if (isset($_SESSION["user"]))
                echo"<button><a href='index.php?action=conversation&conversationId= " . $user->getChat()->getChat()[0]->getConversationId() . "'>Ecrire un message</a></button>";
            else
                echo"Connectez-vous pour lui écrire"; ?>
        </div>
    </div>
</section>


<?php
$library = $user->getLibrary()->getLibrary();

foreach ($library as $book) {
    echo "<div class='book'>";
    echo "<h2><a href='?action=book-details&id=" . $book->getId() . "&userId=".$book->getUser()->getUserId()."' >" . $book->getTitle() . "</a></h2>";
    echo "<img class='book-img' src='" . $book->getBookPicture() . "' alt='" . $book->getTitle() . "'>";
    echo "<div>Auteur : " . $book->getAuthor()->getFirstname() . " " . $book->getAuthor()->getLastname() . " " .  $book->getAuthor()->getPseudo() . "</div>";
    echo "</div>";
}
echo "</div>";

