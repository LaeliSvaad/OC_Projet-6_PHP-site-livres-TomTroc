<?php

class UserPageController
{
    public function showPublicUserPage() : void
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

                if(isset($_SESSION["user"]))
                {
                    $conversationManager = new ConversationManager();
                    $conversationManager->getConversationByUsersId($_SESSION["user"], $user->getId());
                }

            }
            $view = new View('user-public-account');
            $view->render("user-public-account", ['user' => $user]);
        }

    }

    public function showPrivateUserPage() : void
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
                $chatManager = new chatManager();
                $userChat = $chatManager->getChat($userId);
                $user->setChat($userChat);
            }

            $view = new View('user-private-account');
            $view->render("user-private-account", ['user' => $user]);
        }
    }
}