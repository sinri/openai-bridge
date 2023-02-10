<?php

namespace sinri\openai\bridge\openai\v1;

use RuntimeException;
use sinri\openai\bridge\openai\OpenaiApiRequest;

class GetModelsRequest extends OpenaiApiRequest
{
    public function call(): GetModelsResponse
    {
        $responseMeta = null;
        $result = $this->callGet($this->apiPath(), []);
        if (!$result) {
            throw new RuntimeException();
        }
        return new GetModelsResponse($result);
    }

    protected function apiPath(): string
    {
        return "/v1/models";
    }
}