<?php
/**
 * Ce fichier est le template principal qui "contient" ce qui aura été généré par les autres vues.
 *
 * Les variables qui doivent impérativement être définie sont :
 *      $title string : le titre de la page.
 *      $content string : le contenu de la page.
 */

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TomTroc - <?= $title ?></title>
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
<header>
    <div class="navbar">
        <div class="logo">
            <img src="pictures/logo_tomtroc.png" alt="logo tomtroc">
            <h1 class="main-title">Tom Troc</h1>
        </div>
        <nav>
            <div class="nav-links">
                <div class="nav-link"><a href="index.php">Accueil</a></div>
                <div class="nav-link"><a href="index.php?action=nos-livres">Nos livres à l'échange</a></div>
                <div class="nav-link"><a href="index.php?action=messagerie">Messagerie</a></div>
                <div class="nav-link"><a href="index.php?action=user-account">Mon compte</a></div>
                <?php
                if (isset($_SESSION['user']))
                    echo "<div class='nav-link'><a href='index.php?action=deconnexion'>Déconnexion</a></div>";
                else
                    echo"<div class='nav-link'><a href='index.php?action=connexion'>Connexion</a></div>";
                ?>
            </div>
        </nav>
    </div>
</header>

<main>
    <?= $content ?>
</main>

<footer>
    <div class="footer">
        <div class="footer-content"><a href="#">Politique de confidentialité</a></div>
        <div class="footer-content"><a href="#">Mentions légales</a></div>
        <div class="footer-content"><a href="#">Tom Troc©</a></div>
        <div class="footer-content"><img src="pictures/logo_tomtroc_green.png"></div>
    </div>
</footer>

</body>
</html>