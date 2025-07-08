<?php
/**
 * Entité Conversation
 */
class Conversation extends AbstractEntity
{
    private array $conversation;

    protected int $id;

   public function addMessage(Message $message): void
    {
        $this->conversation[] = $message;
    }

    public function getConversation(): array
    {
        return $this->conversation;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }
}