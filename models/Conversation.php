<?php
/**
 * Entité Conversation
 */
class Conversation extends AbstractEntity
{
    private array $conversation;

    private int $conversationId;

   public function addMessage(Message $message): void
    {
        $this->conversation[] = $message;
    }

    public function getConversation(): array
    {
        return $this->conversation;
    }

    public function getConversationId(): int
    {
        return $this->conversationId;
    }

    public function setConversationId(int $id): void
    {
        $this->conversationId = $id;
    }
}