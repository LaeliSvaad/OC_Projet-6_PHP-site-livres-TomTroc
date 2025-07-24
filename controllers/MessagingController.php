<?php

class MessagingController
{
    public function showConversation() : void
    {
        $user1Id = Utils::request("user1Id", -1);
        $user2Id = Utils::request("user2Id", -1);
        $conversationId = Utils::request("conversationId", -1);
        $conversationManager = new ConversationManager();
        if($user1Id != -1 && $user2Id != -1)
            $conversation = $conversationManager->getConversationByUsersId($user1Id, $user2Id);
        else
            $conversation = $conversationManager->getConversationById($conversationId);
        if(is_null($conversation))
        {
            $conversation = new Conversation(["conversationId" => $conversationId, "user1Id" => $user1Id, "user2Id" => $user2Id]);
        }
        $view = new View('conversation');
        $view->render("conversation", ['conversation' => $conversation]);

    }

    public function showChat() : void
    {
        $userId = $_SESSION["user"];
        $chatManager = new ChatManager();
        $chat = $chatManager->getChat($userId);
        $view = new View('chat');
        $view->render("chat", ['chat' => $chat]);
    }

    public function sendMessage() : void
    {
        $userId = Utils::request("senderId");
        $text = Utils::request("message");
        $conversationId = Utils::request("conversationId");

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
        if($messageManager->sendMessage($message))
        {
            $conversationManager = new ConversationManager();
            $conversation = $conversationManager->getConversationById($conversationId);
            $view = new View('conversation');
            $view->render("conversation", ['conversation' => $conversation]);
        }
        else
        {
            throw new Exception("Une erreur est survenue lors de l'envoi du message.");
        }

    }
}