<?php

namespace sinri\openai\bridge\openai;

use RuntimeException;
use sinri\ark\core\ArkHelper;

class OpenaiApiResponse
{
    private array $parsed;

    public function __construct(string $resp)
    {
        $this->parsed = json_decode($resp, true);
    }

    public function getDataAsList(): array
    {
        if ($this->getObjectType() != "list") {
            throw new RuntimeException();
        }
        return ArkHelper::readTarget($this->parsed, "data");
    }

    public function getObjectType()
    {
        // options: list, model, text_completion
        return ArkHelper::readTarget($this->parsed, "object");
    }

    /**
     * @return array
     */
    protected function getParsed(): array
    {
        return $this->parsed;
    }
}