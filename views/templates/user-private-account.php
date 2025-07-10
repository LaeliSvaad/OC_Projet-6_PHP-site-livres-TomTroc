<section>
    <div class="main-content-row">
        <div class="content-block">
            <div class="profile-picture">
                <img src="<?= $user->getPicture() ?>" alt="<?= $user->getNickname() ?> profile picture" />
            </div>
            <h2><?= $user->getNickname() ?></h2>
            <span>Membre depuis <?= Utils::dateInterval($user->getRegistrationDate()) ?></span>
            <span>Bibliothèque</span>
            <span>livres</span>
        </div>
        <div class="content-block">
            <h3>Vos informations personnelles</h3>
            <label for="input-email" >Adresse email</label>
            <input type="email" id="input-email" value="<?= $user->getEmail() ?>" />
            <label for="input-pwd" >Mot de passe</label>
            <input type="password" id="input-pwd" />
            <label for="pseudo" >Pseudo</label>
            <input type="text" id="input-text" value="<?= $user->getNickname() ?>" />
            <input type="submit" value="Enregistrer" />
        </div>
    </div>
    <div class="content-block">

    </div>
</section>

