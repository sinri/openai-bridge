<?php

namespace sinri\openai\bridge\web;

use sinri\ark\core\ArkHelper;

require_once __DIR__ . "/../../../vendor/autoload.php";

date_default_timezone_set(ArkHelper::TIMEZONE_SHANGHAI);

Ark()->loadConfigFileWithPHPFormat(__DIR__ . '/../../../config/config.php');

$webService = Ark()->webService();
$webService->getRouter()
    ->loadAutoRestfulControllerRoot(
        "bridge/",
        "sinri\\openai\\bridge\\web\\controller",
        []
    );
$webService->handleRequestForWeb();
