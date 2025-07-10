<?php

class UserPageController
{
    public function showUserPage()
    {
        if(isset($_SESSION["user"]) && !Utils::request("id"))
        {
            $userManager = new UserManager();
            $user = $userManager->getUserById($_SESSION["user"]);
            $view = new View('user-private-account');
            $view->render("user-private-account", ['user' => $user]);
        }
        else if(Utils::request("id"))
        {
            $userManager = new UserManager();
            $user = $userManager->getUserById(Utils::request("id"));
            $view = new View('user-public-account');
            $view->render("user-public-account", ['user' => $user]);
        }
        else{
            $view = new View('sign-in');
            $view->render("sign-in");
        }
    }

}