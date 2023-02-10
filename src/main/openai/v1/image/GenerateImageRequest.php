<?php

namespace sinri\openai\bridge\openai\v1\image;

use sinri\openai\bridge\openai\OpenaiApiRequest;

class GenerateImageRequest extends OpenaiApiRequest
{
    /**
     * @var string
     * A text description of the desired image(s). The maximum length is 1000 characters.
     */
    private string $prompt;
    /**
     * @var int n integer Optional
     * Defaults to 1
     * The number of images to generate. Must be between 1 and 10.
     */
    private int $n = 1;
    /**
     * @var int `256`, `512`, `1024`
     */
    private int $sizeLevel = 1024;
    /**
     * @var string Optional
     * Defaults to url
     * The format in which the generated images are returned. Must be one of `url` or `b64_json`.
     */
    private string $responseFormat = 'url';
    /**
     * @var string|null Optional
     * A unique identifier representing your end-user, which can help OpenAI to monitor and detect abuse. Learn more.
     */
    private ?string $user = null;

    public function __construct(string $prompt)
    {
        parent::__construct();
        $this->prompt = $prompt;
    }

    /**
     * @param int $n
     * @return GenerateImageRequest
     */
    public function setN(int $n): GenerateImageRequest
    {
        $this->n = $n;
        return $this;
    }

    /**
     * @param int $sizeLevel
     * @return GenerateImageRequest
     */
    public function setSizeLevel(int $sizeLevel): GenerateImageRequest
    {
        $this->sizeLevel = $sizeLevel;
        return $this;
    }

    /**
     * @param string $responseFormat
     * @return GenerateImageRequest
     */
    public function setResponseFormat(string $responseFormat): GenerateImageRequest
    {
        $this->responseFormat = $responseFormat;
        return $this;
    }

    /**
     * @param string $user
     * @return GenerateImageRequest
     */
    public function setUser(string $user): GenerateImageRequest
    {
        $this->user = $user;
        return $this;
    }

    public function call(): GenerateImageResultEntity
    {
        $body = [
            'prompt' => $this->prompt,
            'n' => $this->n,
            'size' => $this->size(),
            'response_format' => $this->responseFormat,
        ];
        if ($this->user !== null) {
            $body['user'] = $this->user;
        }
        $result = $this->callPostJson($this->apiPath(), [], $body);
        return GenerateImageResultEntity::fromJsonString($result);
    }

    /**
     * @return string
     * The size of the generated images. Must be one of 256x256, 512x512, or 1024x1024.
     */
    protected function size(): string
    {
        return $this->sizeLevel . 'x' . $this->sizeLevel;
    }

    protected function apiPath(): string
    {
        return "/v1/images/generations";
    }
}