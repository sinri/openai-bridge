<?php

namespace sinri\openai\bridge\web\controller;

use sinri\ark\web\exception\ArkWebRequestFailed;
use sinri\ark\web\implement\ArkWebController;
use sinri\openai\bridge\azure\chat\completion\AzureOpenaiChatCompletionsApiRequest;
use sinri\openai\bridge\azure\chat\completion\ChatMessage;
use sinri\openai\bridge\OpenaiBridgeCore;

class AzureOpenaiApiV1 extends ArkWebController
{
    public function chat()
    {
        $messages = $this->_readRequest('messages');
        if (!is_array($messages)) {
            throw new ArkWebRequestFailed("messages is invalid");
        }

        $core = OpenaiBridgeCore::getAzureOpenaiSDKCore("seventh_gpt4");
        $sdk = new AzureOpenaiChatCompletionsApiRequest($core);
        foreach ($messages as $message) {
            $sdk->addMessageEntity(new ChatMessage($message));
        }
        $resp = $sdk->requestForChatCompletion();
        $this->_sayOK($resp->getProperties());
    }
}