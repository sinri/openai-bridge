<?php

namespace sinri\openai\bridge\test;

use sinri\openai\bridge\azure\chat\completion\AzureOpenaiChatCompletionsApiRequest;
use sinri\openai\bridge\azure\chat\completion\ChatFunctionDefinition;
use sinri\openai\bridge\azure\chat\completion\ChatFunctionDefinitionParameters;
use sinri\openai\bridge\OpenaiBridgeCore;

require_once __DIR__ . '/../../vendor/autoload.php';

Ark()->loadConfigFileWithPHPFormat(__DIR__ . '/../../config/config.php');

// for Azure OpenAI Sixth

$core = OpenaiBridgeCore::getAzureOpenaiSDKCore("seventh_gpt4");
$sdk = new AzureOpenaiChatCompletionsApiRequest($core);
$resp = $sdk->addMessageForSystem("你现在是店铺售前客户顾问，需要为顾客回答商品销售相关问题。")
    ->addMessageForUser("请问店里有安卓手机吗？")
    ->setFunctionCall("auto")
    ->setFunctions([
        new ChatFunctionDefinition(
            "product_seek_func",
            "根据商品名称、类型、品牌等关键字查询有无商品。",
            (new ChatFunctionDefinitionParameters())
                ->addParameter("keyword", "string", "用于根据相关信息查询商品的关键词", true)
        )
    ])
    ->requestForChatCompletion();

echo "DEBUG: " . json_encode($resp->getProperties()) . PHP_EOL;

echo "ID: " . $resp->id . PHP_EOL;
echo "Model: " . $resp->model . PHP_EOL;
echo "Object: " . $resp->object . PHP_EOL;
echo "Usage: total_tokens=" . $resp->getUsageEntity()->total_tokens
    . " prompt_tokens=" . $resp->getUsageEntity()->prompt_tokens
    . " completion_tokens=" . $resp->getUsageEntity()->completion_tokens
    . PHP_EOL;
echo "Choices: " . PHP_EOL;
$choices = $resp->getChoiceEntities();
foreach ($choices as $choice) {
    echo "\tIndex " . $choice->index . " Object " . $choice->object . " Finish Reason" . $choice->finish_reason . PHP_EOL;
    $msg = $choice->getMessageEntity();
    if ($msg->asContent()) {
        echo "\tBy " . $msg->role . " : " . $msg->content . PHP_EOL;
    } elseif ($msg->asFunctionCall()) {
        $fc = $msg->getFunctionCall();
        echo "\tBy " . $msg->role . " To call function " . $fc->name . "(";
        foreach ($fc->getParsedArguments() as $k => $v) {
            echo $k . '=' . $v . ', ';
        }
        echo ");" . PHP_EOL;
    } else {
        echo "???" . PHP_EOL;
    }
}

echo PHP_EOL . "FIN" . PHP_EOL;