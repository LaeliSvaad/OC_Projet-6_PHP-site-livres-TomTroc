<h2>Modifier les informations</h2>
<div>
    <img class='book-img' src='<?= $book->getBookPicture() ?>' alt='<?= $book->getTitle() ?>'>
    <form action="index.php?action=edit-book" method="post" enctype="multipart/form-data" id="uploadForm">
        <input type="file" name="picture" id="imageUpload" style="display: none;" onchange="document.getElementById('uploadForm').submit();">
    </form>
</div>
<div>
    <form method='post' action='index.php?action=edit-book'>
        <?php
        echo "<label for='input-title' >Titre: </label>";
        echo "<input type='text' id='input-title' name='title' value='" . $book->getTitle() . "'/>";
        echo "<input type='hidden' name='bookId' value='" . $book->getId() . "'/>";
        echo "<label for='input-author' >Auteur: </label>";
        echo "<input type='text' id='input-author' name='author' value='" . $book->getAuthor()->getFirstname() . " " . $book->getAuthor()->getLastname() . "'/>";
        echo "<label for='input-authorPseudo' >Pseudo de l'auteur: </label>";
        echo "<input type='text' id='input-authorPseudo' name='authorPseudo' value='" . $book->getAuthor()->getPseudo() . "'/>";
        echo "<input type='hidden' name='authorId' value='" . $book->getAuthor()->getAuthorId() . "'/>";
        echo "<label for='input-description' >Description: </label>";
        echo "<textarea name='description' id='input-description'>" . $book->getDescription() . "</textarea>";
        echo "<input type='submit' value='Enregistrer' />";
        ?>
    </form>
</div>

