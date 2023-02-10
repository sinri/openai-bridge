<?php

namespace sinri\openai\bridge\openai;

use sinri\openai\bridge\OpenaiBridgeCore;

abstract class OpenaiApi
{
    private OpenaiSDKCore $SDKCore;

    public function __construct()
    {
        $this->SDKCore = OpenaiBridgeCore::getOpenaiSDKCore();
    }

    /**
     * @return OpenaiSDKCore
     */
    protected function getSDKCore(): OpenaiSDKCore
    {
        return $this->SDKCore;
    }

    abstract protected function apiPath();
}