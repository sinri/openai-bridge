<?php

namespace sinri\openai\bridge\openai\v1\chat;

use sinri\openai\bridge\openai\AbstractEntity;
use sinri\openai\bridge\openai\v1\completion\CompletionUsageEntity;

/**
 * @property-read string id
 * @property-read int created
 * @property-read array choices
 * @property-read array usage
 */
class ChatResultEntity extends AbstractEntity
{
    /*
     * {
  "id": "chatcmpl-123",
  "object": "chat.completion",
  "created": 1677652288,
  "choices": [{
    "index": 0,
    "message": {
      "role": "assistant",
      "content": "\n\nHello there, how may I assist you today?",
    },
    "finish_reason": "stop"
  }],
  "usage": {
    "prompt_tokens": 9,
    "completion_tokens": 12,
    "total_tokens": 21
  }
}
     */

    /**
     * @var ChatChoiceEntity[]
     */
    private array $choiceEntities = [];
    private CompletionUsageEntity $usageEntity;

    public function __construct(array $array)
    {
        parent::__construct($array);
        $this->assetObjectType("chat.completion");
        foreach ($this->choices as $b) {
            $this->choiceEntities[] = new ChatChoiceEntity($b);
        }
        $this->usageEntity = new CompletionUsageEntity($this->usage);
    }

    /**
     * @return ChatChoiceEntity[]
     */
    public function getChoices(): array
    {
        return $this->choiceEntities;
    }

    /**
     * @return CompletionUsageEntity
     */
    public function getUsageEntity(): CompletionUsageEntity
    {
        return $this->usageEntity;
    }
}