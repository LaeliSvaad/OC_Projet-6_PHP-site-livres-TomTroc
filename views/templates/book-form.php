<div class="container-fluid">
    <h2>Modifier les informations</h2>
        <div class="col-sm-6">
            <div class='book-img'><img src='<?= $book->getBookPicture() ?>' alt='<?= $book->getTitle() ?>'></div>
            <form action="index.php?action=edit-book" method="post" enctype="multipart/form-data" id="uploadForm">
                <input type="file" name="picture" id="imageUpload" onchange="document.getElementById('uploadForm').submit();">
            </form>
        </div>
        <div class="col-sm-6">
            <form class="form-horizontal" method='post' action='index.php?action=edit-book'>
                <?php
                echo "<div class='form-group'>";
                echo "<label class='control-label' for='input-title' >Titre: </label>";
                echo "<input class='form-control input-lg' type='text' id='input-title' name='title' value='" . $book->getTitle() . "'/>";
                echo "<input type='hidden' name='bookId' value='" . $book->getId() . "'/>";
                echo "</div>";
                echo "<div class='form-group'>";
                echo "<label class='control-label' for='input-author' >Auteur: </label>";
                echo "<input class='form-control input-lg' type='text' id='input-author' name='author' value='" . $book->getAuthor()->getFirstname() . " " . $book->getAuthor()->getLastname() . "'/>";
                echo "</div>";
                echo "<div class='form-group'>";
                echo "<label class='control-label' for='input-authorPseudo' >Pseudo de l'auteur: </label>";
                echo "<input class='form-control input-lg' type='text' id='input-authorPseudo' name='authorPseudo' value='" . $book->getAuthor()->getPseudo() . "'/>";
                echo "<input type='hidden' name='authorId' value='" . $book->getAuthor()->getAuthorId() . "'/>";
                echo "</div>";
                echo "<div class='form-group'>";
                echo "<label class='control-label' for='input-description' >Commentaire: </label>";
                echo "<textarea id='input-description' class='form-control input-lg' name='description'>" . $book->getDescription() . "</textarea>";
                echo "</div>";
                echo "<div class='form-group'>";
                echo "<label class='control-label' for='input-disponibilite' >Disponibilité: </label>";
                echo "<select class='form-control input-lg' name='disponibilite' id='input-disponibilite'>";
                foreach (BookStatus::cases() as $status) {
                    echo '<option value="' . $status->value . '">' . $status->getLabel() . '</option>';
                }
                echo"</select>";
                echo "</div>";
                echo "<div class='form-group'>";
                echo "<input class='btn green-button' type='submit' value='Enregistrer' />";
                echo "</div>";
                ?>
            </form>
        </div>
    </div>
</div>
