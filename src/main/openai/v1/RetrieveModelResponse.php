<?php

namespace sinri\openai\bridge\openai\v1;

use sinri\ark\core\ArkHelper;
use sinri\openai\bridge\openai\OpenaiApiResponse;

class RetrieveModelResponse extends OpenaiApiResponse
{
    public function getId()
    {
        return ArkHelper::readTarget($this->getParsed(), ['id']);
    }
}