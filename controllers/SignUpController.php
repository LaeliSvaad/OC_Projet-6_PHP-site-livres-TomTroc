<?php

class SignUpController
{
    public function addUser() : void
    {
        $params["nickname"] = Utils::controlNickname(Utils::request("nickname"));
        $params["email"] = Utils::controlEmail(Utils::request("email"));
        $params["password"] = Utils::controlPassword(Utils::request("password"));
        $params["picture"] = Utils::request("picture");
        //0.dcfd$params["picture"] = Utils::controlPicture(Utils::request("picture"));
        var_dump(Utils::request("picture"));
        var_dump($params);

        $user = new User($params);
        $userManager = new UserManager();
        $success = $userManager->addUser($user);
        if($success){
            $view = new View('sign-up');
            $view->render("sign-up");
        }
        else{
            $view = new View('sign-up');
            $view->render("sign-up");
        }
    }

    public function showForm() : void
    {
        $view = new View('sign-up');
        $view->render("sign-up");
    }
}