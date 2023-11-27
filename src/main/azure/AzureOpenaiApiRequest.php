<?php

namespace sinri\openai\bridge\azure;

use RuntimeException;
use sinri\ark\io\curl\ArkCurl;

abstract class AzureOpenaiApiRequest
{
    private AzureOpenaiSDKCore $core;

    public function __construct(AzureOpenaiSDKCore $core)
    {
        $this->core = $core;
    }

    public function callApi(string $api, array $body): array
    {
        $c = new ArkCurl();
        $resp = $c->prepareToRequestURL("POST", $this->generateApiUrl($api))
            ->setHeader("api-key", $this->core->getApiKey())
            ->setContentTypeAsJsonInHeader()
            ->setPostContent($body)
            ->execute();
        if ($resp === null || $resp === false) {
            throw new RuntimeException("Call Azure Openai API Failed");
        }
        $x = json_decode($resp, true);
        if (!is_array($x)) {
            throw new RuntimeException("Call Azure Openai API But Responded Error");
        }

        return $x;
    }

    protected function generateApiUrl(string $api): string
    {
        return "https://{$this->core->getResourceName()}.openai.azure.com/openai/deployments/{$this->core->getDeploymentId()}/$api?api-version={$this->core->getApiVersion()}";
    }
}