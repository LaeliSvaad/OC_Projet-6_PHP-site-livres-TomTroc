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
            <span><?= $user->getLibrary()->countBooks() ?></span>
            <span>livres</span>
            <?php if (isset($_SESSION["user"]))
                echo"<button><a href='index.php?action=conversation&user1Id= " . $user->getUserId() . "&user2Id=" . $_SESSION["user"] . "'>Ecrire un message</a></button>";
            else
                echo"Connectez-vous pour lui écrire"; ?>
        </div>
    </div>
</section>

<section>


  <div class="row">
            <?php
            $library = $user->getLibrary()->getLibrary();
            foreach ($library as $book) {
                echo "<div class='col-sm-2 book-card'>";
                echo "<a href='?action=book-details&id=". $book->getId() . "&userId=" .$book->getUser()->getUserId(). "'>";
                echo "<div class='book-img'>";
                echo "<img src='" . $book->getBookPicture() . "' alt='" . $book->getTitle() . "'>";
                echo "</div>";
                echo "<div class='book-info'>";
                echo "<h3>" . $book->getTitle() . "</h3>";
                echo "<span>" . $book->getAuthor()->getFirstname() . " " . $book->getAuthor()->getLastname() . "</span>";
                echo "<span class='italic'>Vendu par: " . $book->getUser()->getNickname() . "</span>";
                echo "</div>";
                echo "</a>";
                echo "</div>";
            }
            ?>
    </div>
</section>


