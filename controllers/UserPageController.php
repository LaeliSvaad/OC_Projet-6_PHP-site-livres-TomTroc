<?php

class UserPageController
{
    public function showUserPage()
    {
        if(isset($_SESSION['user']))
            $idConnectedUser = $_SESSION['user'];
        else
            $idConnectedUser = null;

        if(!is_null($idConnectedUser) && !Utils::request("id"))
        {
            $userManager = new UserManager();
            $user = $userManager->getUserById($_SESSION["user"], $idConnectedUser);
            $view = new View('user-private-account');
            $view->render("user-private-account", ['user' => $user]);
        }
        else if(!is_null(Utils::request("id")))
        {
            $userManager = new UserManager();
            $user = $userManager->getUserById(Utils::request("id"), $idConnectedUser);
            $view = new View('user-public-account');
            $view->render("user-public-account", ['user' => $user]);
        }
        else{
            $view = new View('sign-in');
            $view->render("sign-in");
        }
    }

}