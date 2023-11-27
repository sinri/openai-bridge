<?php

namespace sinri\openai\bridge;

use sinri\openai\bridge\azure\AzureOpenaiSDKCore;
use sinri\openai\bridge\openai\OpenaiSDKCore;

class OpenaiBridgeCore
{

    public static function getOpenaiSDKCore(): OpenaiSDKCore
    {
        return new OpenaiSDKCore(Ark()->readConfig(["openai", "key"]), Ark()->readConfig(["openai", "org_id"]));
    }

    public static function getAzureOpenaiSDKCore(string $name): AzureOpenaiSDKCore
    {
        return new AzureOpenaiSDKCore(
            Ark()->readConfig(["azure", $name, "resource_name"]),
            Ark()->readConfig(["azure", $name, "deployment_id"]),
            Ark()->readConfig(["azure", $name, "api_version"]),
            Ark()->readConfig(["azure", $name, "api_key"]),
        );
    }

}