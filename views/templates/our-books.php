<section>
    <div class='container-fluid'>
        <div class='row'>
            <div class='col-xs-12 col-sm-9'>
                <h2 class='playfair-display-title-font'>Nos livres à l'échange</h2>
            </div>
            <div class='col-xs-12 col-sm-3'>
                <form method='post' action='index.php?action=search-book'>
                    <label for='booksearch'>
                        <img src='pictures/magnifying.png'>
                    </label>
                    <input type='search' placeholder='Rechercher un livre' name='booksearch'>
                </form>
            </div>
        </div>
        <div class='row'>
            <?php foreach ($library as $book):
                $bookId   = $book->getId();
                $user     = $book->getUser();
                $userId   = $user->getUserId();
                $author   = $book->getAuthor();
                $isOwner  = isset($_SESSION['user']) && $_SESSION['user'] == $userId; ?>
            <div class="col-xs-6 col-sm-3 book-card">
                <a href="?action=book-details&id=<?= $bookId ?>&userId=<?= $userId ?>">
                    <div class="book-img">
                        <img src="<?=$book->getBookPicture() ?>" alt="<?= $book->getTitle() ?>">
                    </div>
                    <div class="book-info">
                        <h3><?= $book->getTitle() ?></h3>
                        <span><?= $author->getFirstname() . ' ' . $author->getLastname() ?></span>
                        <span class="italic"><?= $isOwner ? 'Vendu par vous.' : 'Vendu par : ' . $user->getNickname() ?></span>
                    </div>
                </a>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>


