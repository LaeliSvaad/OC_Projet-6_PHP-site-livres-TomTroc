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
    <nav>
        <a href="index.php">Accueil</a>
        <a href="index.php?action=nos-livres">Nos livres à l'échange</a>
        <a href="index.php?action=messagerie">Messagerie</a>
        <a href="index.php?action=mon-compte">Mon compte</a>
        <a href="index.php?action=connexion">Connexion</a>
    </nav>
    <h1>TomTroc</h1>
</header>

<main>
    <?= $content ?>
</main>

<footer>

</footer>

</body>
</html>