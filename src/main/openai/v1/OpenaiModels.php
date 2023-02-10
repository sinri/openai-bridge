<?php

namespace sinri\openai\bridge\openai\v1;

use sinri\openai\bridge\openai\OpenaiApi;

class OpenaiModels extends OpenaiApi
{
    public function call()
    {
        $responseMeta = null;
        $result = $this->getSDKCore()->callGet($this->apiPath(), [], $responseMeta);
        return $result;
    }

    protected function apiPath()
    {
        return "/v1/models";
    }
}