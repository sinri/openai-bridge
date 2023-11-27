<?php

namespace sinri\openai\bridge\openai\v1\chat;

use sinri\openai\bridge\openai\OpenaiApiRequest;

class ChatRequest extends OpenaiApiRequest
{
    /**
     * @var string ID of the model to use. Currently, only `gpt-3.5-turbo` and `gpt-3.5-turbo-0301` are supported.
     */
    private string $model;
    /**
     * @var array The messages to generate chat completions for, in the chat format.
     */
    private array $messages;
    /**
     * We generally recommend altering this or top_p but not both.
     * What sampling temperature to use, between 0 and 2. Higher values like 0.8 will make the output more random, while lower values like 0.2 will make it more focused and deterministic.
     * @var float|null
     */
    private ?float $temperature = null;
    /**
     * An alternative to sampling with temperature, called nucleus sampling, where the model considers the results of the tokens with top_p probability mass. So 0.1 means only the tokens comprising the top 10% probability mass are considered.
     * We generally recommend altering this or temperature but not both.
     * @var float|null
     */
    private ?float $topP = null;
    /**
     * @var int How many chat completion choices to generate for each input message.
     */
    private int $n = 1;
    /**
     * If set, partial message deltas will be sent, like in ChatGPT. Tokens will be sent as data-only server-sent events as they become available, with the stream terminated by a data: [DONE] message.
     * @var bool
     */
    private bool $stream = false;
    /**
     * Up to 4 sequences where the API will stop generating further tokens.
     * @var string|array|null
     */
    private $stop = null;
    /**
     * The maximum number of tokens allowed for the generated answer.
     * By default, the number of tokens the model can return will be (4096 - prompt tokens).
     * @var int|null
     */
    private ?int $maxTokens = null;
    /**
     * Number between -2.0 and 2.0. Positive values penalize new tokens based on whether they appear in the text so far, increasing the model's likelihood to talk about new topics.
     * See more information about frequency and presence penalties.
     * @var float|null
     */
    private ?float $presencePenalty = null;
    /**
     * Number between -2.0 and 2.0. Positive values penalize new tokens based on their existing frequency in the text so far, decreasing the model's likelihood to repeat the same line verbatim.
     * See more information about frequency and presence penalties.
     * @var float|null
     */
    private ?float $frequencyPenalty = null;
    /**
     * Modify the likelihood of specified tokens appearing in the completion.
     * Accepts a json object that maps tokens (specified by their token ID in the tokenizer) to an associated bias value from -100 to 100. Mathematically, the bias is added to the logits generated by the model prior to sampling. The exact effect will vary per model, but values between -1 and 1 should decrease or increase likelihood of selection; values like -100 or 100 should result in a ban or exclusive selection of the relevant token.
     * @var float|null
     */
    private ?float $logitBias = null;
    /**
     * A unique identifier representing your end-user, which can help OpenAI to monitor and detect abuse.
     * Learn more.
     * @var string|null
     */
    private ?string $user = null;

    public function __construct(string $model, array $messages = [])
    {
        parent::__construct();
        $this->model = $model;
        $this->messages = $messages;
    }

    /**
     * @param ChatRequestMessagesBuilder $messagesBuilder
     * @return ChatRequest
     */
    public function rebuildMessages(ChatRequestMessagesBuilder $messagesBuilder): ChatRequest
    {
        $this->messages = $messagesBuilder->toMessages();
        return $this;
    }

    /**
     * @param float|null $temperature
     * @return ChatRequest
     */
    public function setTemperature(?float $temperature): ChatRequest
    {
        $this->temperature = $temperature;
        return $this;
    }

    /**
     * @param float|null $topP
     * @return ChatRequest
     */
    public function setTopP(?float $topP): ChatRequest
    {
        $this->topP = $topP;
        return $this;
    }

    /**
     * @param int $n
     * @return ChatRequest
     */
    public function setN(int $n): ChatRequest
    {
        $this->n = $n;
        return $this;
    }

    /**
     * @param bool $stream
     * @return ChatRequest
     */
    public function setStream(bool $stream): ChatRequest
    {
        $this->stream = $stream;
        return $this;
    }

    /**
     * @param array|string|null $stop
     * @return ChatRequest
     */
    public function setStop($stop): ChatRequest
    {
        $this->stop = $stop;
        return $this;
    }

    /**
     * @param int|null $maxTokens
     * @return ChatRequest
     */
    public function setMaxTokens(?int $maxTokens): ChatRequest
    {
        $this->maxTokens = $maxTokens;
        return $this;
    }

    /**
     * @param float|null $presencePenalty
     * @return ChatRequest
     */
    public function setPresencePenalty(?float $presencePenalty): ChatRequest
    {
        $this->presencePenalty = $presencePenalty;
        return $this;
    }

    /**
     * @param float|null $frequencyPenalty
     * @return ChatRequest
     */
    public function setFrequencyPenalty(?float $frequencyPenalty): ChatRequest
    {
        $this->frequencyPenalty = $frequencyPenalty;
        return $this;
    }

    /**
     * @param float|null $logitBias
     * @return ChatRequest
     */
    public function setLogitBias(?float $logitBias): ChatRequest
    {
        $this->logitBias = $logitBias;
        return $this;
    }

    /**
     * @param string|null $user
     * @return ChatRequest
     */
    public function setUser(?string $user): ChatRequest
    {
        $this->user = $user;
        return $this;
    }

    public function call(): ChatResultEntity
    {
        $body = [
            'model' => $this->model,
            'messages' => $this->messages,
        ];
        if ($this->temperature != null) {
            $body['temperature'] = $this->temperature;
        }
        if ($this->topP != null) {
            $body['top_p'] = $this->topP;
        }
        if ($this->n != null) {
            $body['n'] = $this->n;
        }
        if ($this->stream != null) {
            $body['stream'] = $this->stream;
        }
        if ($this->stop != null) {
            $body['stop'] = $this->stop;
        }
        if ($this->maxTokens != null) {
            $body['max_tokens'] = $this->maxTokens;
        }
        if ($this->presencePenalty != null) {
            $body['presence_penalty'] = $this->presencePenalty;
        }
        if ($this->frequencyPenalty != null) {
            $body['frequency_penalty'] = $this->frequencyPenalty;
        }
        if ($this->logitBias != null) {
            $body['logit_bias'] = $this->logitBias;
        }
        if ($this->user != null) {
            $body['user'] = $this->user;
        }

        $result = $this->callPostJson($this->apiPath(), [], $body);
        return ChatResultEntity::fromJsonString($result);
    }

    protected function apiPath(): string
    {
        return "/v1/chat/completions";
    }
}