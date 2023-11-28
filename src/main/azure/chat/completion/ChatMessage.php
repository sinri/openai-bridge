<?php

namespace sinri\openai\bridge\azure\chat\completion;

use RuntimeException;
use sinri\openai\bridge\core\AbstractEntity;

/**
 * A single, role-attributed message within a chat completion interaction.
 * @property string|null content
 * @property string role
 * @property mixed|null $function_call
 * @property string|null name
 */
class ChatMessage extends AbstractEntity
{
    public static function build(string $role, string $content, $function_call = null, $name = null): ChatMessage
    {
        $body = [
            'role' => $role,
            'content' => $content,
        ];
        if ($function_call !== null) {
            $body['function_call'] = $function_call;
        }
        if ($role === 'function') {
            $body['name'] = $name;
        }
        return new ChatMessage($body);
    }

    public function asFunctionCall(): bool
    {
        return !empty($this->function_call);
    }

    public function asContent(): bool
    {
        return !empty($this->content);
    }

    public function getFunctionCall(): ChatFunctionCall
    {
        if (!$this->asFunctionCall()) throw new RuntimeException("NOT FUNCTION CALL RESPONSE MESSAGE");
        return new ChatFunctionCall($this->function_call['name'], $this->function_call['arguments']);
    }

    public function getContent(): string
    {
        if (!$this->asContent() || $this->content === null) throw new RuntimeException("NOT CONTENT RESPONSE MESSAGE");
        return $this->content;
    }
}