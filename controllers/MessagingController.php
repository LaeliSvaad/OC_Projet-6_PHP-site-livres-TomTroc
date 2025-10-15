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

        /*On récupère le dernier message de chaque conversation de l'utilisateur connecté*/
        $chatManager = new ChatManager();
        $chat = $chatManager->getChat($connectedUserId);
        $chat->setConnectedUser($connectedUser);
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
        }
        $view = new View('chat');
        $view->render("chat", ['chat' => $chat, 'conversation' => $conversation]);
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