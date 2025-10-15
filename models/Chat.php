<?php

class Chat extends AbstractEntity
{
    private ?array $chat = [];
    private ?User $connectedUser = null;
    private int $unreadMessagesCount = 0;

    public function setConnectedUser(?User $connectedUser): void
    {
       $this->connectedUser= $connectedUser;
    }
    public function getConnectedUser(): ?User
    {
        return $this->connectedUser;
    }
    public function setUnreadMessagesCount(int $unreadMessagesCount): void
    {
        $this->unreadMessagesCount = $unreadMessagesCount;
    }
    public function getUnreadMessagesCount(): int
    {
        return $this->unreadMessagesCount;
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