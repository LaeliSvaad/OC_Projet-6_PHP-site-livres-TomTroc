<div class="main-content container-fluid">
    <h2 class="playfair-display-title-font">Mon compte</h2>
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <div class="inner-col private-user-page-col">
                <form action="index.php?action=modify-user" method="post" enctype="multipart/form-data" id="uploadForm">
                    <label for="imageUpload">
                        <div class="block-content user-picture-input-div">
                            <img class="profile-picture" src="<?= $user->getPicture() ?>" alt="<?= $user->getNickname() ?> profile picture" />
                            <span class="input-file-span">Modifier</span>
                        </div>
                    </label>
                    <input type="file" name="picture" id="imageUpload" onchange="document.getElementById('uploadForm').submit();">
                </form>
                <div>
                    <h3 class="playfair-display-title-font"><?= $user->getNickname() ?></h3>
                    <span>Membre depuis <?= Utils::dateInterval($user->getRegistrationDate()) ?></span>
                    <span>Bibliothèque</span>
                    <span><?= $user->getLibrary()->countBooks() ?> livres</span>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <div class="inner-col private-user-page-col">
                <h3>Vos informations personnelles</h3>
                <form method='post' action='index.php?action=modify-user'>
                    <label for="input-email" >Adresse email</label>
                    <input type="email" id="input-email" name='email' value="<?= $user->getEmail() ?>"/>
                    <label for="input-pwd" >Mot de passe</label>
                    <input type="password" id="input-pwd" name="password" value="" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;"/>
                    <label for="input-nickname" >Pseudo</label>
                    <input type="text" id="input-nickname" name='nickname' value="<?= $user->getNickname() ?>" />
                    <input type="hidden" name="userId" value="<?= $user->getUserId() ?>"/>
                    <input type="submit" value="Enregistrer" />
                </form>
            </div>
        </div>
    </div>
    <div class="row user-white-block">
        <?php $library = $user->getLibrary()->getLibrary(); ?>
        <table>
            <tr><th>Photo</th><th>Titre</th><th>Auteur</th><th>Description</th><th>Disponibilité</th><th>Action</th></tr>
            <?php foreach ($library as $book):
                $author = $book->getAuthor();
                $status = $book->getStatus(); ?>
            <tr>
                <td><img class='table-book-img' src='<?= $book->getBookPicture() ?>' alt='<?= $book->getTitle()?>'></td>
                <td><?= $book->getTitle() ?></td>
                <td><?= $author->getFirstname() . " " . $author->getLastname() ?></td>
                <td><?= $book->getDescription()?></td>
                <td><?= $status->getLabel() ?></td>
                <td><a href='index.php?action=book-form&id=". $book->getId() ."' >Editer</a><a href='index.php?action=delete-book&id=" . $book->getId() . "' >Supprimer</a></td>
            </tr>
            <?php endforeach;  ?>
        </table>
    </div>
</div>

