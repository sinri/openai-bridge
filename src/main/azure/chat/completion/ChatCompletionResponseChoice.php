<?php

namespace sinri\openai\bridge\azure\chat\completion;

use sinri\openai\bridge\core\AbstractEntity;

/**
 * @property-read array message
 * @property-read string finish_reason
 * @property-read int index
 */
class ChatCompletionResponseChoice extends AbstractEntity
{
    public function getMessageEntity(): ChatMessage
    {
        return new ChatMessage($this->message);
    }
}