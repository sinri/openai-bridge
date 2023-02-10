<?php

namespace sinri\openai\bridge\openai;

use sinri\ark\io\curl\ArkCurl;

class OpenaiSDKCore
{
    private string $apiKey;
    private string $orgId;

    public function __construct(string $apiKey, string $orgId)
    {
        $this->apiKey = $apiKey;
        $this->orgId = $orgId;
    }

    public function callGet(string $path, array $queries = [], &$responseMeta = null)
    {
        $curl = new ArkCurl(Ark()->logger("openai-api"));
        $curl->prepareToRequestURL("GET", "https://api.openai.com" . $path);
        if (!empty($queries)) {
            foreach ($queries as $k => $v) {
                $curl->setQueryField($k, $v);
            }
        }
        $result = $curl->setHeader("Authorization", "Bearer " . $this->getApiKey())
            ->setHeader("OpenAI-Organization", $this->getOrgId())
            ->execute();
        $responseMeta = $curl->getResponseMeta();
        return $result;
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