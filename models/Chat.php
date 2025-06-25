<?php
/**
 * Entité Conversation
 */
class Chat extends AbstractEntity
{
    private array $chat = [];
    private int $user1Id;
    private int $user2Id;

    protected int $id;

    public function addMessage(Message $message): void
    {
        $this->chat[] = $message;
    }

    public function getChat(): array
    {
        return $this->chat;
    }

    public function setUser1Id(int $user1Id): void
    {
        $this->user1Id = $user1Id;
    }

    public function setUser2Id(int $user2Id): void
    {
        $this->user2Id = $user2Id;
    }

    public function getUser1Id(): int
    {
        return $this->user1Id;
    }

    public function getUser2Id(): int
    {
        return $this->user2Id;
    }

    public function setId(int $id) : void
    {
        $this->id = $id;
    }

    public function getId() : int
    {
        return $this->id;
    }


}