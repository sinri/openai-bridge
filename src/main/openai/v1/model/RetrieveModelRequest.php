<?php

namespace sinri\openai\bridge\openai\v1\model;

use sinri\openai\bridge\openai\OpenaiApiRequest;

class RetrieveModelRequest extends OpenaiApiRequest
{
    private string $modelId;

    public function __construct(string $modelId)
    {
        parent::__construct();
        $this->modelId = $modelId;
    }

    public function call(): ModelEntity
    {
        $result = $this->callGet($this->apiPath());
        return ModelEntity::fromJsonString($result);
    }

    protected function apiPath(): string
    {
        return "/v1/models/" . $this->modelId;
    }
}