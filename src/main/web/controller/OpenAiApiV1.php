<?php

namespace sinri\openai\bridge\web\controller;

use sinri\ark\io\exception\TargetFileNotFoundError;
use sinri\ark\web\exception\ArkWebRequestFailed;
use sinri\ark\web\implement\ArkWebController;
use sinri\openai\bridge\openai\v1\completion\CompletionRequest;
use sinri\openai\bridge\openai\v1\image\GenerateImageRequest;
use sinri\openai\bridge\openai\v1\model\GetModelsRequest;

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

    public function generateImageForUrl()
    {
        $prompt = $this->_readIndispensableRequest("prompt");
        $api = new GenerateImageRequest($prompt);
        $api->setN(1);
        $result = $api->call();
        $urls = $result->getImageUrls();
        $this->_sayOK(['image_urls' => $urls]);
    }

    public function generateImageForOutput()
    {
        $prompt = $this->_readIndispensableRequest("prompt");
        $api = new GenerateImageRequest($prompt);
        $api->setN(1);
        $result = $api->call();
        $urls = $result->getImageUrls();
        if (empty($urls)) throw new ArkWebRequestFailed("not image generated");
        try {
            $done = $this->_getOutputHandler()->downloadFileIndirectly($urls[0]);
        } catch (TargetFileNotFoundError $e) {
            throw new ArkWebRequestFailed('image generated but url invalid', ['url' => $urls[0]], 404, $e);
        }
    }
}