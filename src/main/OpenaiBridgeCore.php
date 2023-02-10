<?php
namespace sinri\openai\bridge;

use sinri\ark\core\ArkLogger;

class OpenaiBridgeCore
{
    public static function logger(): ArkLogger
    {
        return ArkLogger::getDefaultLogger();
    }
}