<?php
/**
 * Entité Message
 */
class Message extends AbstractEntity
{
    private int $chatId;

    private Datetime $datetime;

    private int $senderId;

    private string $content;

    private boolean $status;

    protected int $id;

    public function setId(int $id) : void
    {
        $this->id = $id;
    }

    public function getId() : int
    {
        return $this->id;
    }

    public function setChatId(int $chatId) : void
    {
        $this->chatId = $chatId;
    }

    public function getChatId() : int
    {
        return $this->chatId;
    }

    public function setSenderId(int $senderId) : void
    {
        $this->senderId = $senderId;
    }

    public function getSenderId() : int
    {
        return $this->senderId;
    }

    public function setDatetime(Datetime $datetime) : void
    {
        $this->datetime = $datetime;
    }

    public function getDatetime() : Datetime
    {
        return $this->datetime;
    }

    public function setContent(string $content) : void
    {
        $this->content = $content;
    }

    public function getContent() : string
    {
        return $this->content;
    }

    public function setStatus($status) : void
    {
        $this->status = $status;
    }

    public function getStatus() : boolean
    {
        return $this->status;
    }

}