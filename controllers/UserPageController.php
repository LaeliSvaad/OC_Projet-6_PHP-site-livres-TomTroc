<?php

class UserPageController
{
    public function showUserPage()
    {
        $id = Utils::request("id");
        $userManager = new UserManager();
        $user = $userManager->getUserById($id);
        var_dump($user);
        $view = new View('utilisateur');
        $view->render("utilisateur", ["user" => $user]);
    }

    public function showMyAccount()
    {
        if(isset($_SESSION["user"]))
        {
            $view = new View('utilisateur');
            $view->render("utilisateur", [$_SESSION["user"]]);
        }
        else
        {
            $view = new View('sign-in');
            $view->render("sign-in");
        }
    }

}