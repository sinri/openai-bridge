<?php

namespace sinri\openai\bridge\openai;

use sinri\ark\io\curl\ArkCurl;
use sinri\openai\bridge\OpenaiBridgeCore;

abstract class OpenaiApiRequest
{
    private OpenaiSDKCore $SDKCore;
    protected ?array $responseMeta;

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

    abstract protected function apiPath(): string;

    public function callGet(string $path, array $queries = [])
    {
        $curl = new ArkCurl(Ark()->logger("openai-api"));
        $curl->prepareToRequestURL("GET", "https://api.openai.com" . $path);
        if (!empty($queries)) {
            foreach ($queries as $k => $v) {
                $curl->setQueryField($k, $v);
            }
        }
        $result = $curl->setHeader("Authorization", "Bearer " . $this->getSDKCore()->getApiKey())
            ->setHeader("OpenAI-Organization", $this->getSDKCore()->getOrgId())
            ->execute();
        $this->responseMeta = $curl->getResponseMeta();
        return $result;
    }

    public function callPostJson(
        string $path,
        array  $queries = [],
        array  $body = []
    )
    {
        $curl = new ArkCurl(Ark()->logger("openai-api"));
        $curl->prepareToRequestURL("POST", "https://api.openai.com" . $path);
        if (!empty($queries)) {
            foreach ($queries as $k => $v) {
                $curl->setQueryField($k, $v);
            }
        }
        if (!empty($body)) {
            $curl->setContentTypeAsJsonInHeader();
            $curl->setPostContent($body);
        }
        $result = $curl->setHeader("Authorization", "Bearer " . $this->getSDKCore()->getApiKey())
            ->setHeader("OpenAI-Organization", $this->getSDKCore()->getOrgId())
            ->execute();
        $this->responseMeta = $curl->getResponseMeta();
        return $result;
    }

    public function callPostForm(
        string $path,
        array  $queries = [],
        array  $fields = []
    )
    {
        $curl = new ArkCurl(Ark()->logger("openai-api"));
        $curl->prepareToRequestURL("POST", "https://api.openai.com" . $path);
        if (!empty($queries)) {
            foreach ($queries as $k => $v) {
                $curl->setQueryField($k, $v);
            }
        }
        if (!empty($fields)) {
            foreach ($fields as $k => $v) {
                $curl->setPostFormField($k, $v);
            }
        }
        $result = $curl->setHeader("Authorization", "Bearer " . $this->getSDKCore()->getApiKey())
            ->setHeader("OpenAI-Organization", $this->getSDKCore()->getOrgId())
            ->execute();
        $this->responseMeta = $curl->getResponseMeta();
        return $result;
    }
}