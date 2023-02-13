<?php

namespace sinri\openai\bridge\web;

use sinri\ark\web\ArkRequestFilter;

class Customs extends ArkRequestFilter
{

    public function shouldAcceptRequest($path, $method, $params, &$preparedData = null, &$responseCode = 200, &$error = null)
    {
        $bridgePassToken = Ark()->webInput()->getHeaderHelper()->getHeader("X-BRIDGE-PASS-TOKEN");
        $bridgePassId = Ark()->webInput()->getHeaderHelper()->getHeader("X-BRIDGE-PASS-ID");
        $bridgePassTime = Ark()->webInput()->getHeaderHelper()->getHeader("X-BRIDGE-PASS-TIME");

        $bridgeSecret = Ark()->readConfig(['bridge', 'secret']);

        $expectedToken = md5($bridgePassId . ':' . $bridgeSecret . '@' . $bridgePassTime);

        if ($bridgePassTime < (time() - 2 * 60) || $bridgePassTime > (time() + 2 * 60)) {
            $responseCode = 403;
            $error = "GO AWAY!";
            return false;
        }

        if ($expectedToken === $bridgePassToken) {
            $responseCode = 403;
            $error = "GO AWAY!!";
            return false;
        }

        $preparedData['pass_id'] = $bridgePassId;
        return true;
    }

    public function filterTitle()
    {
        return __METHOD__;
    }
}