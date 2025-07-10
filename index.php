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

        case 'our-books':
            $libraryController = new LibraryController();
            $libraryController->showLibrary();
            break;

        case 'book-details':
            $bookController = new BookController();
            $bookController->showBook();
            break;

        case 'search-book':
            $libraryController = new LibraryController();
            $libraryController->showSearchResults();
            break;

        case 'edit-book':
            $messagingController = new BookController();
            $messagingController->editBook();
            break;

        case 'add-book':
            $messagingController = new LibraryController();
            $messagingController->addBook();
            break;

        case 'delete-book':
            $messagingController = new LibraryController();
            $messagingController->deleteBook();
            break;

        case 'connexion':
            $signInController = new SignInController();
            $signInController->showForm();
            break;

        case 'deconnexion':
            $signInController = new SignInController();
            $signInController->disconnectUser();
            break;

        case 'registration-form':
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

        case 'user-private-account':
            $userPageController = new UserPageController();
            $userPageController->showUserPage();
            break;

        case 'user-public-account':
            $userPageController = new UserPageController();
            $userPageController->showUserPage();
            break;

        case 'edit-user':
            $userPageController = new UserPageController();
            $userPageController->showUserPage();
            break;

        case 'conversation':
            $messagingController = new MessagingController();
            $messagingController->showConversation();
            break;

        case 'chat':
            $messagingController = new MessagingController();
            $messagingController->showChat();
            break;

        case 'send-message':
            $messagingController = new MessagingController();
            $messagingController->sendMessage();
            break;

        default:
            throw new Exception("Erreur 404: page non trouvée.");
    }
} catch (Exception $e) {
    // En cas d'erreur, on affiche la page d'erreur.
    $errorView = new View('Erreur');
    $errorView->render('error-page', ['errorMessage' => $e->getMessage()]);
}
