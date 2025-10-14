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
        $userId = Utils::request("senderId");
        $text = Utils::request("message");
        $conversationId = Utils::request("conversationId");
        $seenByRecipient = Utils::request("seenByRecipient");

        if(!isset($conversationId)){
            $user1Id = Utils::request("user1Id");
            $user2Id = Utils::request("user2Id");
            if(isset($user1Id) && isset($user2Id)){
                $conversation = new Conversation(["user1Id" => (int)Utils::controlUserInput($user1Id),
                    "user2Id" => (int)Utils::controlUserInput($user2Id)]);
                $conversationManager = new ConversationManager();
                if($conversationManager->addConversation($conversation))
                {
                    $conversationId = $conversationManager->getLastConversationId();
                    if($conversationId == 0)
                        throw new Exception("Une erreur est survenue lors de l'envoi du message.");
                }
            }
            else
            {
                throw new Exception("Une erreur est survenue lors de l'envoi du message.");
            }
        }

        $sender = new User(["userId" => $userId]);
        $message = new Message([
            "text" => $text,
            "sender" => $sender,
            "seenByRecipient" => false,
            "conversationId" => $conversationId]);
        $messageManager = new MessageManager();

        if(isset($seenByRecipient)){
            $seenByRecipient = (int)Utils::controlUserInput($seenByRecipient);
            $messageManager->updateMessageStatus($seenByRecipient);
        }

        if($messageManager->sendMessage($message))
        {
            $conversationManager = new ConversationManager();
            $conversation = $conversationManager->getConversationById($conversationId);

            $chatManager = new ChatManager();
            $chat = $chatManager->getChat($userId);

            $view = new View('chat');
            $view->render("chat", ['chat' => $chat, 'conversation' => $conversation]);
        }
        else
        {
            throw new Exception("Une erreur est survenue lors de l'envoi du message.");
        }

    }
}