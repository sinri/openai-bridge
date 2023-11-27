<?php

namespace sinri\openai\bridge\azure\chat\completion;

use sinri\openai\bridge\core\AbstractEntity;

/**
 * A single, role-attributed message within a chat completion interaction.
 * @property string content
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
}