<?php

namespace sinri\openai\bridge\openai\v1;

use sinri\ark\core\ArkHelper;
use sinri\openai\bridge\openai\OpenaiApiResponse;

class CreateCompletionResponse extends OpenaiApiResponse
{
    public function getId()
    {
        return ArkHelper::readTarget($this->getParsed(), ['id']);
    }

    public function getCreated()
    {
        return ArkHelper::readTarget($this->getParsed(), ['created']);
    }

    public function getModel()
    {
        return ArkHelper::readTarget($this->getParsed(), ['model']);
    }

    /**
     * @return CreateCompletionResponseChoice[]
     */
    public function getChoices(): array
    {
        $a = ArkHelper::readTarget($this->getParsed(), ['choices']);
        $choices = [];
        if (is_array($a)) {
            foreach ($a as $b) {
                $choices[] = new CreateCompletionResponseChoice($b);
            }
        }
        return $choices;
    }

    public function getUsage()
    {
        // "prompt_tokens": 5,
        //    "completion_tokens": 7,
        //    "total_tokens": 12
        return ArkHelper::readTarget($this->getParsed(), ['usage']);
    }
}