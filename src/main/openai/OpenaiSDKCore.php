<?php

namespace sinri\openai\bridge\openai;

class OpenaiSDKCore
{
    private string $apiKey;
    private string $orgId;

    public function __construct(string $apiKey, string $orgId)
    {
        $this->apiKey = $apiKey;
        $this->orgId = $orgId;
    }

    public function getApiKey(): string
    {
        return $this->apiKey;
    }

    public function getOrgId(): string
    {
        return $this->orgId;
    }
}