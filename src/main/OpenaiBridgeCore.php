<?php

namespace sinri\openai\bridge;

use sinri\openai\bridge\openai\OpenaiSDKCore;

class OpenaiBridgeCore
{

    public static function getOpenaiSDKCore(): OpenaiSDKCore
    {
        return new OpenaiSDKCore(Ark()->readConfig(["openai", "key"]), Ark()->readConfig(["openai", "org_id"]));
    }
}