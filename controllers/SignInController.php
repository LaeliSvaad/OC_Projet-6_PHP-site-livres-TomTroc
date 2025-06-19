<?php
class SignInController
{
    public function connectUser() : void
    {
        // On récupère les données du formulaire.
        $nickname = Utils::request("nickname");
        $email = Utils::request("email");
        $password = Utils::request("password");

        // On vérifie que les données sont valides.
        if (empty($nickname) || empty($email) || empty($password)) {
            throw new Exception("Tous les champs sont obligatoires.");
        }

        // On vérifie que l'utilisateur existe.
        $userManager = new UserManager();
        $user = $userManager->getUser($nickname, $email);

        if (!$user) {
            throw new Exception("Une erreur est survenue lors de l'authentification.");
        }

        // On vérifie que le mot de passe est correct.
        if (!password_verify($password, $user->getPassword())) {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            throw new Exception("Une erreur est survenue lors de l'authentification.");
        }

        // On connecte l'utilisateur.
        $_SESSION['user'] = $user->getId();

        // On redirige vers la page mon compte.
        $view = new View('utilisateur');
        $view->render("utilisateur", ['user' => $user]);
    }
    public function showForm() : void
    {
        $view = new View('sign-in');
        $view->render("sign-in");
    }
}