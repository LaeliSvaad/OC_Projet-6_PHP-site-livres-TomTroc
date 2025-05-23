<?php
require_once 'config/config.php';
require_once 'config/autoload.php';

// On récupère l'action demandée par l'utilisateur.
// Si aucune action n'est demandée, on affiche la page d'accueil.
$action = Utils::request('action', 'home');

// Try catch global pour gérer les erreurs
try {
    // Pour chaque action, on appelle le bon contrôleur et la bonne méthode.
    switch ($action) {

        case 'home':
            $homeController = new HomeController();
            $homeController->showHome();
            break;

        case 'nos-livres':
            $libraryController = new LibraryController();
            $libraryController->showLibrary();
            break;

        case 'detail-livre':
            $bookController = new BookController();
            $bookController->showBook();
            break;

        /*case 'connexion':
            $articleController = new ArticleController();
            $articleController->addArticle();
            break;

        case 'inscription':
            $commentController = new CommentController();
            $commentController->addComment();
            break;

        case 'mon-compte':
            $articleController = new ArticleController();
            $articleController->showArticle();
            break;

        case 'modification-livre':
            $articleController = new ArticleController();
            $articleController->showArticle();
            break;

        case 'profil':
            $articleController = new ArticleController();
            $articleController->showArticle();
            break;

        case 'messagerie':
            $articleController = new ArticleController();
            $articleController->showArticle();
            break;*/


        default:
            throw new Exception("La page demandée n'existe pas.");
    }
} catch (Exception $e) {
    // En cas d'erreur, on affiche la page d'erreur.
    $errorView = new View('Erreur');
    $errorView->render('errorPage', ['errorMessage' => $e->getMessage()]);
}
