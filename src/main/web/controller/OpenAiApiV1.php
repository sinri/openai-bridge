<?php

namespace sinri\openai\bridge\web\controller;

use sinri\ark\web\implement\ArkWebController;
use sinri\openai\bridge\openai\v1\completion\CompletionRequest;
use sinri\openai\bridge\openai\v1\model\GetModelsRequest;

/**
 * http://chat-lab.leqee.com/index.php/bridge/OpenAiApiV1/getModels
 */
class OpenAiApiV1 extends ArkWebController
{
    public function getModels()
    {
        $api = new GetModelsRequest();
        $result = $api->call();

        $models = [];
        for ($i = 0; $i < $result->getTotalModels(); $i++) {
            $model = $result->getModelAt($i);
            $models[] = $model;
        }

        $this->_sayOK([
            'total' => $result->getTotalModels(),
            'models' => $models,
        ]);
    }

    public function completion()
    {
        $model = $this->_readIndispensableRequest("model");

        $api = new CompletionRequest($model);

        $prompt = $this->_readRequest("prompt");
        if (!empty($prompt)) {
            $api->setPrompt($prompt);
        }

        $max_tokens = $this->_readRequest("max_tokens", 1024);
        $api->setMaxTokens($max_tokens);

        $temperature = $this->_readRequest("temperature");
        if (!empty($temperature)) {
            $api->setTemperature($temperature);
        }
        $topP = $this->_readRequest("top_p");
        if (!empty($topP)) {
            $api->setTopP($topP);
        }

        $n = $this->_readRequest("n", 1);
        $api->setN($n);

        $resp = $api->call();

        $choices = $resp->getChoiceEntities();
        $choiceArray = [];
        foreach ($choices as $choice) {
            $choiceArray[] = $choice->getProperties();
        }

        $this->_sayOK([
            'id' => $resp->id,
            'usage' => $resp->getUsageEntity()->getProperties(),
            'choices' => $choiceArray,
        ]);
    }
}