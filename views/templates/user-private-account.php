<section>
    <div class="main-content-row">
        <div class="content-block">
            <div class="profile-picture">
                <img src="<?= $user->getPicture() ?>" alt="<?= $user->getNickname() ?> profile picture" />
                <a href="#" onclick="document.getElementById('imageUpload').click();">
                    Modifier l'image
                </a>
                <form action="index.php?action=modify-user" method="post" enctype="multipart/form-data" id="uploadForm">
                    <input type="file" name="picture" id="imageUpload" style="display: none;" onchange="document.getElementById('uploadForm').submit();">
                </form>
            </div>
            <h2><?= $user->getNickname() ?></h2>
            <span>Membre depuis <?= Utils::dateInterval($user->getRegistrationDate()) ?></span>
            <span>Bibliothèque</span>
            <span><?= $user->getLibrary()->countBooks() ?></span>
            <span>livres</span>
        </div>
        <div class="content-block">
            <h3>Vos informations personnelles</h3>
            <form method='post' action='index.php?action=modify-user'>
                <label for="input-email" >Adresse email</label>
                <input type="email" id="input-email" name='email' placeholder="<?= $user->getEmail() ?>" value="" />
                <label for="input-pwd" >Mot de passe</label>
                <input type="password" id="input-pwd" name="password" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;"/>
                <label for="input-nickname" >Pseudo</label>
                <input type="text" id="input-nickname" name='nickname' placeholder="<?= $user->getNickname() ?>" value="" />
                <input type="hidden" name="userId" value="<?= $user->getUserId() ?>"/>
                <input type="submit" value="Enregistrer" />
            </form>
        </div>
    </div>
</section>

<section>
    <?php
    $library = $user->getLibrary()->getLibrary();
    echo "<table>";
    echo "<tr><th>Photo</th><th>Titre</th><th>Auteur</th><th>Description</th><th>Disponibilité</th><th>Action</th></tr>";
    foreach ($library as $book) {
        echo "<tr>";
        echo "<td><img class='book-img' src='" . $book->getBookPicture() . "' alt='" . $book->getTitle() . "'></td>";
        echo "<td>" . $book->getTitle() . "</td>";
        echo "<td>" . $book->getAuthor()->getFirstname() . " " . $book->getAuthor()->getLastname() . "</td>";
        echo "<td>" . $book->getDescription() . "</td>";
        echo "<td>" . $book->getStatus() . "</td>";
        echo "<td><a href='index.php?action=edit-book&id=". $book->getId() ."' >Modifier</a> <a href='index.php?action=delete-book&id=" . $book->getId() . "' >Supprimer</a></td>";
        echo "</tr>";
    }
    echo "</table>";
    ?>
</section>

