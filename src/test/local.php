<?php

namespace sinri\openai\bridge\test;

use sinri\openai\bridge\azure\chat\completion\AzureOpenaiChatCompletionsApiRequest;
use sinri\openai\bridge\OpenaiBridgeCore;

require_once __DIR__ . '/../../vendor/autoload.php';

Ark()->loadConfigFileWithPHPFormat(__DIR__ . '/../../config/config.php');

// for Azure OpenAI Sixth

$core = OpenaiBridgeCore::getAzureOpenaiSDKCore("seventh_gpt4");
$sdk = new AzureOpenaiChatCompletionsApiRequest($core);
$resp = $sdk->addMessageForSystem("你现在是Java专家，需要回答Java相关的技术问题。")
    ->addMessageForUser("用Java 17实现静态单例，需要在启动后按需初始化，问如何避免初始化时的并发冲突？")
    ->requestForChatCompletion();

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
    echo "\tBy " . $msg->role . " : " . $msg->content . PHP_EOL;
}

echo PHP_EOL . "FIN" . PHP_EOL;