<?php

class UserPageController
{
    public function showUserPage()
    {
        if(isset($_SESSION["user"]))
        {
            $userManager = new UserManager();
            $user = $userManager->getUserById($_SESSION["user"]);
            $view = new View('utilisateur');
            $view->render("utilisateur", ['user' => $user]);
        }
        else
        {
            $view = new View('sign-in');
            $view->render("sign-in");
        }
    }

}