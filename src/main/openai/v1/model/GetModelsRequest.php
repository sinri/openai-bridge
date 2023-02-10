<?php

namespace sinri\openai\bridge\openai\v1\model;

use sinri\openai\bridge\openai\OpenaiApiRequest;

class GetModelsRequest extends OpenaiApiRequest
{
    public function call(): ModelsEntity
    {
        $result = $this->callGet($this->apiPath());
        return ModelsEntity::fromJsonString($result);
    }

    protected function apiPath(): string
    {
        return "/v1/models";
    }
}