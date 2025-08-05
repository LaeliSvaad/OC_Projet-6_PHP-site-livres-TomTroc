<?php

class UserPageController
{
    public function showPublicUserPage(): void
    {
        if(is_null(Utils::request("id")))
        {
            $view = new View('Erreur');
            $view->render("error-page");
        }
        else
        {
            $userId= Utils::request("id");
            $userManager = new UserManager();
            $user = $userManager->getPublicUserById($userId);

            if(!is_null($user))
            {
                $libraryManager = new LibraryManager();
                $userLibrary = $libraryManager->getLibraryByUserId($userId);
                $user->setLibrary($userLibrary);
                $chat = new Chat();
                if(isset($_SESSION["user"]))
                {
                    $conversationManager = new ConversationManager();
                    $conversation =  $conversationManager->getConversationByUsersId($_SESSION["user"], $user->getUserId());
                    $chat->addConversation($conversation);
                }
                $user->setChat($chat);
            }
            $view = new View('user-public-account');
            $view->render("user-public-account", ['user' => $user]);
        }

    }

    public function showPrivateUserPage(): void
    {
        if(!isset($_SESSION['user']))
        {
            $view = new View('sign-in');
            $view->render("sign-in");
        }
        else
        {
            $userId = $_SESSION['user'];
            $userManager = new UserManager();
            $user = $userManager->getPrivateUserById($userId);
            if(!is_null($user))
            {
                $libraryManager = new LibraryManager();
                $userLibrary = $libraryManager->getLibraryByUserId($userId);
                $user->setLibrary($userLibrary);
                $chatManager = new ChatManager();
                $userChat = $chatManager->getChat($userId);
                $user->setChat($userChat);
            }

            $view = new View('user-private-account');
            $view->render("user-private-account", ['user' => $user]);
        }
    }

    public function modifyUser(): void
    {
        $userRequest["nickname"] = Utils::request("nickname");
        $userRequest["email"] = Utils::request("email");
        $userRequest["password"] = Utils::request("password");
        $userRequest["picture"] = Utils::request("picture");
        $userRequest["userId"]= Utils::request("userId");

        if(!isset($userRequest["userId"]) || $userRequest["userId"] == 0)
            throw new Exception("Une erreur est survenue lors de la mise à jour de vos informations.");
        else
            $userRequest["userId"] = (int)Utils::controlUserInput(Utils::request("userId"));

        $userManager = new UserManager();

        foreach ($userRequest as $key => $value) {

            switch ($key) {
                case 'nickname':
                    if($userRequest["nickname"] != null)
                    {
                        $userRequest["nickname"] = Utils::controlUserInput($userRequest["nickname"]);
                        $modif = $userManager->modifyUserNickname($userRequest["nickname"], $userRequest["userId"]);
                        if($modif == 0)
                            throw new Exception("Une erreur est survenue lors de la mise à jour de vos informations.");
                    }
                    continue 2;

                case 'email':
                    if($userRequest["email"] != null)
                    {
                        $userRequest["email"] = Utils::controlUserInput($userRequest["email"]);
                        $modif = $userManager->modifyUserEmail($userRequest["email"], $userRequest["userId"]);
                        if($modif == 0)
                            throw new Exception("Une erreur est survenue lors de la mise à jour de vos informations.");
                    }
                    continue 2;

                case 'password':
                    if($userRequest["password"] != null)
                    {
                        $userRequest["password"] = Utils::controlPassword($userRequest["password"]);
                        $modif = $userManager->modifyUserPassword($userRequest["password"], $userRequest["userId"]);
                        if($modif == 0)
                            throw new Exception("Une erreur est survenue lors de la mise à jour de vos informations.");
                    }
                    continue 2;

                case 'picture':
                    if($userRequest["picture"] != null)
                    {
                        $userRequest["picture"] = Utils::controlProfilePicture($userRequest["picture"]);
                        $modif = $userManager->modifyUserPicture($userRequest["picture"], $userRequest["userId"]);
                        if($modif == 0)
                            throw new Exception("Une erreur est survenue lors de la mise à jour de vos informations.");
                    }
                    break;
            }
        }
        Utils::redirect("user-private-account", ["userId" => $userRequest["userId"]]);
    }
}