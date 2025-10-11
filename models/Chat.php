<?php

class Chat extends AbstractEntity
{
    private ?array $chat = [];
    private ?User $connectedUser = null;

    public function setConnectedUser(?User $connectedUser): void
    {
       $this->connectedUser= $connectedUser;
    }
    public function getConnectedUser(): ?User
    {
        return $this->connectedUser;
    }
    public function addConversation(?Conversation $conversation): void
    {
        $this->chat[] = $conversation;
    }

    public function getChat(): ?array
    {
        return $this->chat;
    }
}