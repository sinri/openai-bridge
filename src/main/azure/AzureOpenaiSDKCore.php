<?php

namespace sinri\openai\bridge\azure;

/**
 * @see https://learn.microsoft.com/zh-cn/azure/ai-services/openai/reference
 */
class AzureOpenaiSDKCore
{

    private string $resourceName;
    private string $deploymentId;
    private string $apiVersion;
    private string $apiKey;

    public function __construct(
        string $resource_name,
        string $deployment_id,
        string $api_version,
        string $api_key
    )
    {
        $this->resourceName = $resource_name;
        $this->deploymentId = $deployment_id;
        $this->apiVersion = $api_version;
        $this->apiKey = $api_key;
    }

    public function getResourceName(): string
    {
        return $this->resourceName;
    }

    public function getDeploymentId(): string
    {
        return $this->deploymentId;
    }

    public function getApiVersion(): string
    {
        return $this->apiVersion;
    }

    public function getApiKey(): string
    {
        return $this->apiKey;
    }


}