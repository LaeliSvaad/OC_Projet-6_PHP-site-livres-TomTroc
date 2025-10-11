<?php

class MessagingController
{
    public function showConversation() : void
    {
        $connectedUserId = $_SESSION["user"];
        $interlocutorId = Utils::request("interlocutorId", -1);

        $chatManager = new ChatManager();
        $conversationManager = new ConversationManager();
        $userManager = new UserManager();

        $chat = $chatManager->getChat($connectedUserId);
        $connectedUser = $userManager->getPublicUserById($connectedUserId);
        $chat->setConnectedUser($connectedUser);

        $conversation = new Conversation();
        $interlocutor = $userManager->getPublicUserById($Id);
        $conversation->setInterlocutor($interlocutor);

        if($connectedUserId != NULL && $interlocutorId != -1)
        {
            $conversation = $conversationManager->getConversationByUsersId($connectedUserId, $interlocutorId);
        }
        else if($interlocutorId === -1 && isset($chat->getChat()[0]))
        {
            $conversationId = $chat->getChat()[0]->getConversationId();
            $conversation = $conversationManager->getConversationById($conversationId, $connectedUserId);
            echo"ici";
        }

        $view = new View('chat');
        $view->render("chat", ['chat' => $chat, 'conversation' => $conversation, 'interlocutor' => $interlocutor]);
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