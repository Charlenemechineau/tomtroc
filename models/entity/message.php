<?php

class Message extends AbstractEntity
{
    private string $message;
    private int $sender_id ;
    private datetime $sent_date;
    private int $conversation_id;

    public function getMessage(): string
    {
        return $this->message;
    }

    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

    public function getSenderId(): int
    {
        return $this->sender_id;
    }

    public function setSenderId(int $sender_id): void
    {
        $this->sender_id = $sender_id;
    }

    public function getSentDate(): DateTime
    {
        return $this->sent_date;
    }

    public function setSentDate(DateTime $sent_date): void
    {
        $this->sent_date = $sent_date;
    }

    public function setConverSationId(int $conversation_id): void
    {
        $this->conversation_id = $conversation_id;
    }

    public function getConversationId() : int
    {
        return $this->conversation_id;
    }
}
