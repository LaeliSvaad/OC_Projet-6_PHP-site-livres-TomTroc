<div class="home-section intro">
    <figure>
        <img class="intro-img" src="pictures/hamza-nouasria.png" alt="photo d'Hamza Nouasria">
        <figcaption>Hamza</figcaption>
    </figure>
    <div class="intro-content">
        <strong>Rejoignez nos lecteurs passionnés</strong>
        <span>Donnez une nouvelle vie à vos livres en les échangeant avec d'autres amoureux de la lecture. Nous croyons en la magie du partage de connaissances et d'histoires à travers les livres.</span>
        <button class="button green-button"><a href="index.php?action=our-books" >Voir tous les livres</a></button>
    </div>
</div>
<section>
    <div class="home-section library">
        <h2>Les derniers livres ajoutés</h2>
        <div class="books">
            <?php
            foreach ($library as $book) {
                echo"<div class='book'>";
                echo "<h3><a href='?action=book-details&id=" . $book->getId() . "' >" . $book->getTitle() . "</a></h3>";
                echo "<img class='book-img' src='" . $book->getBookPicture() . "' alt='" . $book->getTitle() . "'>";
                echo "<span>Auteur : " . $book->getAuthor()->getFirstname() . " " . $book->getAuthor()->getLastname() . " " .  $book->getAuthor()->getPseudo() . "</span>";
                echo "<span>Vendu par : <a href='index.php?action=user-public-account&id=" . $book->getUser()->getUserId() . "'>" . $book->getUser()->getNickname() . "</a></span>";
                echo"</div>";
            }
            ?>
        </div>
        <button class="button green-button"><a href="index.php?action=our-books" >Voir tous les livres</a></button>
    </div>
</section>
<section>
    <div class="home-section">
        <strong>Comment ça marche ?</strong>
        <span>Échanger des livres avec TomTroc c’est simple et amusant ! Suivez ces étapes pour commencer :</span>
        <div class="instructions">
            <div class="instruction">Inscrivez-vous gratuitement sur notre plateforme.</div>
            <div class="instruction">Ajoutez les livres que vous souhaitez échanger à votre profil.</div>
            <div class="instruction">Parcourez les livres disponibles chez d'autres membres.</div>
            <div class="instruction">Proposez un échange et discutez avec d'autres passionnés de lecture.</div>
        </div>
        <button class="button transparent-button"><a href="index.php?action=our-books" >Voir tous les livres</a></button>
    </div>
</section>
<div class="home-section banner"><img src="pictures/banner.png" alt="banner"></div>
<section>
    <div class="home-section">
        <h2>Nos valeurs</h2>
        <p>Chez Tom Troc, nous mettons l'accent sur le partage, la découverte et la communauté. Nos valeurs sont ancrées dans notre passion pour les livres et notre désir de créer des liens entre les lecteurs. Nous croyons en la puissance des histoires pour rassembler les gens et inspirer des conversations enrichissantes.</p>
        <p>Notre association a été fondée avec une conviction profonde : chaque livre mérite d'être lu et partagé.</p>
        <p>Nous sommes passionnés par la création d'une plateforme conviviale qui permet aux lecteurs de se connecter, de partager leurs découvertes littéraires et d'échanger des livres qui attendent patiemment sur les étagères.</p>
        <div class="signature"><span>L’équipe Tom Troc</span><img src="pictures/heart_signature.svg" alt="heart signature"></div>
    </div>
</section>

