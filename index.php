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

        case 'connexion':
            $signInController = new SignInController();
            $signInController->showForm();
            break;

        case 'inscription':
            $signUpController = new SignUpController();
            $signUpController->showForm();
            break;

        case 'sign-up':
            $signUpController = new SignUpController();
            $signUpController->addUser();
            break;

        case 'sign-in':
            $signInController = new SignInController();
            $signInController->connectUser();
            break;

        case 'utilisateur':
            $userPageController = new UserPageController();
            $userPageController->showUserPage();
            break;

        case 'mon-compte':
            $userPageController = new UserPageController();
            $userPageController->showMyAccount();
            break;

        case 'messagerie':
            $messagingController = new MessagingController();
            $messagingController->showMessages();
            break;

        /*case 'modification-livre':
            $articleController = new ArticleController();
            $articleController->showArticle();
            break;

        */


        default:
            throw new Exception("La page demandée n'existe pas.");
    }
} catch (Exception $e) {
    // En cas d'erreur, on affiche la page d'erreur.
    $errorView = new View('Erreur');
    $errorView->render('errorPage', ['errorMessage' => $e->getMessage()]);
}
