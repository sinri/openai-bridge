<?php

namespace sinri\openai\bridge\openai\v1\chat;

class ChatRequestMessagesBuilder
{
    private array $array = [];

    public function __construct()
    {

    }

    public function addForSystem(string $content): ChatRequestMessagesBuilder
    {
        $this->array[] = [
            'role' => 'system',
            'content' => $content,
        ];
        return $this;
    }

    public function addForUser(string $content): ChatRequestMessagesBuilder
    {
        $this->array[] = [
            'role' => 'user',
            'content' => $content,
        ];
        return $this;
    }

    public function addForAssistant(string $content): ChatRequestMessagesBuilder
    {
        $this->array[] = [
            'role' => 'assistant',
            'content' => $content,
        ];
        return $this;
    }

    /**
     * @return array
     */
    public function toMessages(): array
    {
        return $this->array;
    }
}