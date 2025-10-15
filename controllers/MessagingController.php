<?php

class MessagingController
{
    public function showConversation() : void
    {
        $connectedUserId = $_SESSION["user"];
        $interlocutorId = Utils::request("interlocutorId", -1);
        $conversationId = Utils::request("conversationId", NULL);

        /*On récupère d'abord les données des 2 utilisateurs: l'interlocuteur de la conversation affichée et l'utilisateur connecté */
        $userManager = new UserManager();
        $interlocutor = $userManager->getPublicUserById($interlocutorId);
        $connectedUser = $userManager->getPublicUserById($connectedUserId);

        /* On récupère la liste de conversation avec le dernier message de chaque conversation pour l'utilisateur connecté */
        $chatManager = new ChatManager();
        $chat = $chatManager->getChat($connectedUserId);
        $chat->setConnectedUser($connectedUser);

        /* Si la liste de conversations est vide, on ne va pas plus loin et on envoie la vue,
        sauf si l'id interlocutor existe (il est récupéré via le lien "envoyer un message" qui figure soit sur le profil public d'un utilisateur, soit sur la page de détail d'un livre).
        On peut alors créer une nouvelle conversation */
        if(empty($chat->getChat()) && $interlocutorId === -1){
            $view = new View('chat');
            $view->render("chat", ['chat' => $chat, 'conversation' => NULL]);
        }
        else if(empty($chat->getChat()) && $interlocutorId != -1){
            /* On crée une conversation vierge qu'on envoie en DB et dont on récupère l'id*/
            $conversationManager = new ConversationManager();
            $conversation = new Conversation();
            $conversation->setInterlocutor($interlocutor);
            if($conversationManager->addConversation($connectedUserId, $interlocutorId) === true)
                $conversation->setConversationId($conversationManager->getLastConversationId());
            else
                throw new Exception("Une erreur est survenue lors de l'initialisation de la conversation.");
            $view = new View('chat');
            $view->render("chat", ['chat' => $chat, 'conversation' => $conversation]);
        }
        else{
            /*On récupère le nombre de messages non lus*/
            $chat->setUnreadMessagesCount($chatManager->getUnreadMessageCount($connectedUserId));

            /*On récupère, pour l'afficher entièrement, la conversation dont le dernier message est le plus récent */
            $conversationManager = new ConversationManager();
            if($interlocutor != NULL){
                $conversation = $conversationManager->getConversationByUsersId($connectedUserId, $interlocutorId);
                $conversation->setInterlocutor($interlocutor);
            }
            else{
                if($conversationId === NULL){
                    $conversationId = $chat->getChat()[0]->getConversationId();
                }
                $conversation = $conversationManager->getConversationById($conversationId, $connectedUserId);
                $interlocutor = $conversationManager->getInterlocutor($connectedUserId, $conversationId);
                $conversation->setInterlocutor($interlocutor);
            }
            $view = new View('chat');
            $view->render("chat", ['chat' => $chat, 'conversation' => $conversation]);
        }

    }

    public function sendMessage() : void
    {
        $userId = $_SESSION["user"];
        $text = Utils::request("message");
        $conversationId = Utils::request("conversationId");
        $seenByRecipientMessageId = Utils::request("seenByRecipientMessageId");
        $sender = new User(["userId" => $userId]);
        $message = new Message([
            "text" => $text,
            "sender" => $sender,
            "seenByRecipient" => false,
            "conversationId" => $conversationId]);
        $messageManager = new MessageManager();

        if(isset($seenByRecipientMessageId)){
            $seenByRecipientMessageId = (int)Utils::controlUserInput($seenByRecipientMessageId);
            if($seenByRecipientMessageId != -1)
                $messageManager->updateMessageStatus($seenByRecipientMessageId);
        }

        if($messageManager->sendMessage($message))
        {
            Utils::redirect("conversation", ["conversationId" => $conversationId]);
        }
        else
        {
            throw new Exception("Une erreur est survenue lors de l'envoi du message.");
        }

    }
}