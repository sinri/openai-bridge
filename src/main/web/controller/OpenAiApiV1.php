<?php

namespace sinri\openai\bridge\web\controller;

use sinri\ark\web\implement\ArkWebController;
use sinri\openai\bridge\openai\v1\OpenaiModels;

class OpenAiApiV1 extends ArkWebController
{
    public function getModels()
    {
        $api = new OpenaiModels();
        $result = $api->call();
        echo $result;
    }
}