<?php
/**
 * Entité Conversation
 */
class Conversation extends AbstractEntity
{
    private array $conversation;

   public function addMessage(Message $message): void
    {
        $this->conversation[] = $message;
    }

    public function getConversation(): array
    {
        return $this->conversation;
    }

}