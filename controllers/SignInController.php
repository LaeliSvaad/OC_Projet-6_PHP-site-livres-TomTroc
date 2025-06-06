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
            throw new Exception("Tous les champs sont obligatoires. 1");
        }

        // On vérifie que l'utilisateur existe.
        $userManager = new UserManager();
        $user = $userManager->getUser($nickname, $email);
        if (!$user) {
            throw new Exception("L'utilisateur demandé n'existe pas.");
        }

        // On vérifie que le mot de passe est correct.
        if (!password_verify($password, $user->getPassword())) {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            throw new Exception("Le mot de passe est incorrect : $hash");
        }

        // On connecte l'utilisateur.
        $_SESSION['user'] = $user;

        // On redirige vers la page mon compte.
        Utils::redirect("mon-compte");
    }
    public function showForm() : void
    {
        $view = new View('sign-in');
        $view->render("sign-in");
    }
}