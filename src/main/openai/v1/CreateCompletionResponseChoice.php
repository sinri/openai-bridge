<?php

namespace sinri\openai\bridge\openai\v1;

use sinri\ark\core\ArkHelper;

class CreateCompletionResponseChoice
{
    private array $choiceDatum;

    public function __construct(array $choiceDatum)
    {
        $this->choiceDatum = $choiceDatum;
    }

    public function getText()
    {
        return ArkHelper::readTarget($this->choiceDatum, ['text']);
    }

    public function getIndex()
    {
        return ArkHelper::readTarget($this->choiceDatum, ['index']);
    }

    public function getLogProbs()
    {
        return ArkHelper::readTarget($this->choiceDatum, ['logprobs']);
    }

    public function getFinishReason()
    {
        return ArkHelper::readTarget($this->choiceDatum, ['finish_reason']);
    }

    public function toJsonObject(): array
    {
        return $this->choiceDatum;
    }
}