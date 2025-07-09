<?php
/**
 * Entité Conversation
 */
class Conversation extends AbstractEntity
{
   private int $user1Id;
   private int $user2Id;
   private ?array $conversation = null;
   private int $conversationId;

    public function getUser1Id(): int
    {
        return $this->user1Id;
    }

    public function setUser1Id(int $id): void
    {
        $this->user1Id = $id;
    }

    public function getUser2Id(): int
    {
        return $this->user2Id;
    }

    public function setUser2Id(int $id): void
    {
        $this->user2Id = $id;
    }

    public function getConversation(): ?array
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

    public function addMessage(Message $message): void
    {
        $this->conversation[] = $message;
    }
}