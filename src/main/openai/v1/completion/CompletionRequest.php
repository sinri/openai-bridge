<?php

namespace sinri\openai\bridge\openai\v1\completion;

use sinri\openai\bridge\openai\OpenaiApiRequest;

class CompletionRequest extends OpenaiApiRequest
{
    /**
     * @var string
     * ID of the model to use. You can use the List models API to see all of your available models, or see our Model overview for descriptions of them.
     */
    private string $modelId;
    /**
     * @var string|null
     * string or array
     * Optional
     * Defaults to <|endoftext|>
     * The prompt(s) to generate completions for, encoded as a string, array of strings, array of tokens, or array of token arrays.
     * Note that
     *  <|endoftext|> is the document separator that the model sees during training,
     *  so if a prompt is not specified the model will generate as if from the beginning of a new document.
     */
    private ?string $prompt = null;
    /**
     * @var string|null
     * The suffix that comes after a completion of inserted text.
     */
    private ?string $suffix = null;
    /**
     * @var int|null integer Optional
     * Defaults to 16
     * The maximum number of tokens to generate in the completion.
     * The token count of your prompt plus max_tokens cannot exceed the model's context length.
     * Most models have a context length of 2048 tokens (except for the newest models, which support 4096).
     */
    private ?int $maxTokens = null;
    /**
     * @var float|null Optional
     * Defaults to 1
     * What sampling temperature to use, between 0 and 2.
     * Higher values like 0.8 will make the output more random, while lower values like 0.2 will make it more focused and deterministic.
     * We generally recommend altering this or top_p but not both.
     */
    private ?float $temperature = null;
    /**
     * @var float|null Optional
     * Defaults to 1
     * An alternative to sampling with temperature, called nucleus sampling,
     *  where the model considers the results of the tokens with top_p probability mass.
     *  So 0.1 means only the tokens comprising the top 10% probability mass are considered.
     * We generally recommend altering this or temperature but not both.
     */
    private ?float $topP = null;
    /**
     * @var int Optional
     * Defaults to 1
     * How many completions to generate for each prompt.
     * Note: Because this parameter generates many completions, it can quickly consume your token quota.
     *  Use carefully and ensure that you have reasonable settings for max_tokens and stop.
     */
    private int $n = 1;
    /**
     * @var bool Optional
     * Defaults to false
     * Whether to stream back partial progress.
     *  If set, tokens will be sent as data-only server-sent events as they become available,
     *  with the stream terminated by a data: [DONE] message.
     */
    private bool $stream = false;
    /**
     * @var int|null Optional
     * Defaults to null
     * Include the log probabilities on the logprobs most likely tokens, as well the chosen tokens.
     *  For example, if logprobs is 5, the API will return a list of the 5 most likely tokens.
     *  The API will always return the logprob of the sampled token, so there may be up to logprobs+1 elements in the response.
     * The maximum value for logprobs is 5.
     *  If you need more than this, please contact us through our Help center and describe your use case.
     */
    private ?int $logProbs = null;
    /**
     * @var bool Optional
     * Defaults to false
     * Echo back the prompt in addition to the completion
     */
    private bool $echo = false;
    /**
     * @var string|array Optional
     * Defaults to null
     * Up to 4 sequences where the API will stop generating further tokens.
     *  The returned text will not contain the stop sequence.
     */
    private $stop = null;
    /**
     * @var float|null number Optional
     * Defaults to 0
     * Number between -2.0 and 2.0.
     *  Positive values penalize new tokens based on whether they appear in the text so far,
     *  increasing the model's likelihood to talk about new topics.
     *
     * See more information about frequency and presence penalties.
     * @see https://platform.openai.com/docs/api-reference/parameter-details
     */
    private ?float $presencePenalty = null;
    /**
     * @var float|null number Optional
     * Defaults to 0
     * Number between -2.0 and 2.0.
     *  Positive values penalize new tokens based on their existing frequency in the text so far,
     *  decreasing the model's likelihood to repeat the same line verbatim.
     *
     * See more information about frequency and presence penalties.
     * @see https://platform.openai.com/docs/api-reference/parameter-details
     */
    private ?float $frequencyPenalty = null;
    /**
     * @var int|null Optional
     * Defaults to 1
     * Generates best_of completions server-side and returns the "best" (the one with the highest log probability per token).
     *  Results cannot be streamed.
     * When used with n, best_of controls the number of candidate completions and n specifies how many to return
     *  – best_of must be greater than n.
     * Note: Because this parameter generates many completions, it can quickly consume your token quota.
     *  Use carefully and ensure that you have reasonable settings for max_tokens and stop.
     */
    private ?int $bestOf = null;
    /**
     * @var array|null map Optional
     * Defaults to null
     * Modify the likelihood of specified tokens appearing in the completion.
     * Accepts a json object that maps tokens (specified by their token ID in the GPT tokenizer)
     *  to an associated bias value from -100 to 100.
     *  You can use this tokenizer tool (which works for both GPT-2 and GPT-3) to convert text to token IDs.
     *  Mathematically, the bias is added to the logits generated by the model prior to sampling.
     *  The exact effect will vary per model, but values between -1 and 1 should decrease or increase likelihood of selection;
     *  values like -100 or 100 should result in a ban or exclusive selection of the relevant token.
     * As an example, you can pass {"50256": -100} to prevent the <|endoftext|> token from being generated.
     */
    private ?array $logitBias = null;
    /**
     * @var string|null Optional
     * A unique identifier representing your end-user, which can help OpenAI to monitor and detect abuse. Learn more.
     */
    private ?string $user = null;

    public function __construct(string $modelId)
    {
        parent::__construct();
        $this->modelId = $modelId;
    }

    /**
     * @param string $prompt
     * @return CompletionRequest
     */
    public function setPrompt(string $prompt): CompletionRequest
    {
        $this->prompt = $prompt;
        return $this;
    }

    /**
     * @param string $suffix
     * @return CompletionRequest
     */
    public function setSuffix(string $suffix): CompletionRequest
    {
        $this->suffix = $suffix;
        return $this;
    }

    /**
     * @param int $maxTokens
     * @return CompletionRequest
     */
    public function setMaxTokens(int $maxTokens): CompletionRequest
    {
        $this->maxTokens = $maxTokens;
        return $this;
    }

    /**
     * @param float $temperature
     * @return CompletionRequest
     */
    public function setTemperature(float $temperature): CompletionRequest
    {
        $this->temperature = $temperature;
        return $this;
    }

    /**
     * @param float $topP
     * @return CompletionRequest
     */
    public function setTopP(float $topP): CompletionRequest
    {
        $this->topP = $topP;
        return $this;
    }

    /**
     * @param int $n
     * @return CompletionRequest
     */
    public function setN(int $n): CompletionRequest
    {
        $this->n = $n;
        return $this;
    }

    /**
     * @param bool $stream
     * @return CompletionRequest
     */
    public function setStream(bool $stream): CompletionRequest
    {
        $this->stream = $stream;
        return $this;
    }

    /**
     * @param int $logProbs
     * @return CompletionRequest
     */
    public function setLogProbs(int $logProbs): CompletionRequest
    {
        $this->logProbs = $logProbs;
        return $this;
    }

    /**
     * @param bool $echo
     * @return CompletionRequest
     */
    public function setEcho(bool $echo): CompletionRequest
    {
        $this->echo = $echo;
        return $this;
    }

    /**
     * @param array|string $stop
     * @return CompletionRequest
     */
    public function setStop($stop): CompletionRequest
    {
        $this->stop = $stop;
        return $this;
    }

    /**
     * @param float $presencePenalty
     * @return CompletionRequest
     */
    public function setPresencePenalty(float $presencePenalty): CompletionRequest
    {
        $this->presencePenalty = $presencePenalty;
        return $this;
    }

    /**
     * @param float $frequencyPenalty
     * @return CompletionRequest
     */
    public function setFrequencyPenalty(float $frequencyPenalty): CompletionRequest
    {
        $this->frequencyPenalty = $frequencyPenalty;
        return $this;
    }

    /**
     * @param int $bestOf
     * @return CompletionRequest
     */
    public function setBestOf(int $bestOf): CompletionRequest
    {
        $this->bestOf = $bestOf;
        return $this;
    }

    /**
     * @param array $logitBias
     * @return CompletionRequest
     */
    public function setLogitBias(array $logitBias): CompletionRequest
    {
        $this->logitBias = $logitBias;
        return $this;
    }

    /**
     * @param string $user
     * @return CompletionRequest
     */
    public function setUser(string $user): CompletionRequest
    {
        $this->user = $user;
        return $this;
    }

    public function call(): CompletionResultEntity
    {
        $body = ['model' => $this->modelId];

        if ($this->prompt !== null) {
            $body['prompt'] = $this->prompt;
        }
        if ($this->suffix !== null) {
            $body['suffix'] = $this->suffix;
        }
        if ($this->maxTokens !== null) {
            $body['max_tokens'] = $this->maxTokens;
        }
        if ($this->temperature !== null) {
            $body['temperature'] = $this->temperature;
        }
        if ($this->topP !== null) {
            $body['top_p'] = $this->topP;
        }
        $body['n'] = $this->n;
        $body['stream'] = $this->stream;
        if ($this->logProbs !== null) {
            $body['logprobs'] = $this->logProbs;
        }
        $body['echo'] = $this->echo;
        if ($this->stop !== null) {
            $body['stop'] = $this->stop;
        }
        if ($this->presencePenalty !== null) {
            $body['presence_penalty'] = $this->presencePenalty;
        }
        if ($this->frequencyPenalty !== null) {
            $body['frequency_penalty'] = $this->frequencyPenalty;
        }
        if ($this->bestOf !== null) {
            $body['best_of'] = $this->bestOf;
        }
        if ($this->logitBias !== null) {
            $body['logit_bias'] = $this->logitBias;
        }
        if ($this->user !== null) {
            $body['user'] = $this->user;
        }

        $result = $this->callPostJson($this->apiPath(), [], $body);
        return CompletionResultEntity::fromJsonString($result);
    }

    protected function apiPath(): string
    {
        return "/v1/completions";
    }
}