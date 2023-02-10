<?php

namespace sinri\openai\bridge\openai\v1;

use sinri\openai\bridge\openai\OpenaiApiRequest;

class RetrieveModelRequest extends OpenaiApiRequest
{
    private string $modelId;

    public function __construct(string $modelId)
    {
        parent::__construct();
        $this->modelId = $modelId;
    }

    public function call()
    {
        $responseMeta = null;
        $result = $this->callGet($this->apiPath(), []);
        if (!!$result) {
            $resp = new GetModelsResponse($result);
        }
        return $result;
    }

    protected function apiPath(): string
    {
        return "/v1/models/" . $this->modelId;
    }
}