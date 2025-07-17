<?php

class Chat extends AbstractEntity
{
    private ?array $chat = [];

    public function addConversation(?Conversation $conversation): void
    {
        $this->chat[] = $conversation;
    }

    public function getChat(): ?array
    {
        return $this->chat;
    }
}