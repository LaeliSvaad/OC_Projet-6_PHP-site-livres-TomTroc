<div>
    <figure>
        <img src="pictures/hamza-nouasria.png" alt="photo d'Hamza Nouasria">
        <figcaption>Hamza</figcaption>
    </figure>

    <strong>Rejoignez nos lecteurs passionnés</strong>
    <span>Donnez une nouvelle vie à vos livres en les échangeant avec d'autres amoureux de la lecture. Nous croyons en la magie du partage de connaissances et d'histoires à travers les livres.</span>
    <button><a href="index.php?action='nos-livres'" >Voir tous les livres</a></button>
</div>

<h2>Les derniers livres ajoutés</h2>
<?php
    foreach ($library as $book) {
    echo"<br>";
    echo "<h2><a href='?action=detail-livre&id=" . $book->getId() . "' >" . $book->getTitle() . "</a></h2>";
    echo "Auteur : " . $book->getAuthor()->getFirstname() . " " . $book->getAuthor()->getLastname() . " " .  $book->getAuthor()->getPseudo() . "<br>";
    echo "Vendu par : <a href='index.php?action=utilisateur&id=" . $book->getUser()->getUserId() . "'>" . $book->getUser()->getNickname() . "</a><br>";
    echo"<br>";
    }
?>
<button><a href="index.php?action='nos-livres'" >Voir tous les livres</a></button>
<strong>Comment ça marche ?</strong>
<span>Échanger des livres avec TomTroc c’est simple et amusant ! Suivez ces étapes pour commencer :</span>
<div class="instructions">Inscrivez-vous gratuitement sur notre plateforme.</div>
<div class="instructions">Ajoutez les livres que vous souhaitez échanger à votre profil.</div>
<div class="instructions">Parcourez les livres disponibles chez d'autres membres.</div>
<div class="instructions">Proposez un échange et discutez avec d'autres passionnés de lecture.</div>
<button><a href="index.php?action='nos-livres'" >Voir tous les livres</a></button>
<div class="banner"><img src="pictures/banner.png" alt="banner"></div>
<h2>Nos valeurs</h2>
<p>Chez Tom Troc, nous mettons l'accent sur le partage, la découverte et la communauté. Nos valeurs sont ancrées dans notre passion pour les livres et notre désir de créer des liens entre les lecteurs. Nous croyons en la puissance des histoires pour rassembler les gens et inspirer des conversations enrichissantes.</p>
<p>Notre association a été fondée avec une conviction profonde : chaque livre mérite d'être lu et partagé.</p>
<p>Nous sommes passionnés par la création d'une plateforme conviviale qui permet aux lecteurs de se connecter, de partager leurs découvertes littéraires et d'échanger des livres qui attendent patiemment sur les étagères.</p>
<span>L’équipe Tom Troc</span>
<div class="signature"><img src="pictures/heart_signature.svg" alt="heart signature"></div>