<?php
$connectedUserId = $_SESSION["user"] ?? null;
$author = $book->getAuthor();
$user = $book->getUser();
$isOwner = $connectedUserId === $user->getUserId();
$bookPicture = $book->getBookPicture();
$bookTitle = $book->getTitle();
$bookDescription = $book->getDescription();
$userPicture = $user->getPicture();
$userNickname = $user->getNickname();
$userId = $user->getUserId();
?>
<section>
    <div class='container-fluid'>
        <div class='row'>
            <div class='col-sm-6'>
                <img class='book-img' src='<?= $bookPicture ?>' alt='<?= $bookTitle ?>'>
            </div>
            <div class="col-sm-6">
                <h2 class="playfair-display-title-font"><?= $bookTitle ?></h2>
                <span>par <strong><?= $author->getFirstname() ?> <?= $author->getLastname() ?></strong></span>
                <span>Description</span>
                <p><?= $bookDescription ?></p>
                <span>Propriétaire</span>
                <div>
                    <a href='<?= $isOwner ? "index.php?action=user-private-account" : "index.php?action=user-public-account&id=$userId" ?>'>
                        <img src='<?= $userPicture ?>' alt='<?= $userNickname ?>'>
                        <span><?= $isOwner ? "Vous" : $userNickname ?></span>
                    </a>
                    <?= !$connectedUserId
                        ? "<p>Créez un compte ou connectez-vous pour lui envoyer un message.</p>"
                        : (!$isOwner
                            ? "<a class='button-link' href='index.php?action=conversation&user1Id=$userId&user2Id=$connectedUserId'><button class='btn green-button'>Envoyer un message</button></a>"
                            : "") ?>
                </div>
            </div>
        </div>
    </div>
</section>