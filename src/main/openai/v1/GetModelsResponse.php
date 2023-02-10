<?php

namespace sinri\openai\bridge\openai\v1;

use sinri\openai\bridge\openai\OpenaiApiResponse;

class GetModelsResponse extends OpenaiApiResponse
{
    public function getTotalModels(): int
    {
        return count($this->getDataAsList());
    }

    public function getModelAt(int $index)
    {
        return $this->getDataAsList()[$index];
    }
}