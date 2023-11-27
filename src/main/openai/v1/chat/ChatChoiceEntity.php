<?php

namespace sinri\openai\bridge\openai\v1\chat;

use sinri\openai\bridge\core\AbstractEntity;

/**
 * @property-read int index
 * @property-read array message
 * @property-read string finish_reason
 */
class ChatChoiceEntity extends AbstractEntity
{
    private ChatChoiceMessageEntity $messageEntity;

    public function __construct(array $array)
    {
        parent::__construct($array);
        $this->messageEntity = new ChatChoiceMessageEntity($this->message);
    }

    public function getMessage(): ChatChoiceMessageEntity
    {
        return $this->messageEntity;
    }
}