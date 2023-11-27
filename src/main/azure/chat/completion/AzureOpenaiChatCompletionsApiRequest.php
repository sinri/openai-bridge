<?php

namespace sinri\openai\bridge\azure\chat\completion;

use sinri\openai\bridge\azure\AzureOpenaiApiRequest;
use sinri\openai\bridge\azure\AzureOpenaiSDKCore;

class AzureOpenaiChatCompletionsApiRequest extends AzureOpenaiApiRequest
{
    private array $requestBody;

    public function __construct(AzureOpenaiSDKCore $core)
    {
        parent::__construct($core);
        $this->requestBody = [
            'messages' => [],
        ];
    }

    public function requestForChatCompletion(): ChatCompletionResponse
    {
        $resp = $this->callApi("chat/completions", $this->requestBody);
        return new ChatCompletionResponse($resp);
    }

    public function addMessageForSystem(string $content): AzureOpenaiChatCompletionsApiRequest
    {
        return $this->addMessageForRole(ChatRole::ROLE_SYSTEM, $content);
    }

    /**
     * @param string $role
     * @param string $content
     * @return $this
     */
    protected function addMessageForRole(string $role, string $content): AzureOpenaiChatCompletionsApiRequest
    {
        return $this->addMessageEntity(ChatMessage::build($role, $content));
    }

    /**
     * The collection of context messages associated with this chat completions request.
     * Typical usage
     *  begins with a chat message for the System role that provides instructions for the behavior of the assistant,
     *  followed by alternating messages between the User and Assistant roles.
     * @param ChatMessage $chatMessage
     * @return $this
     */
    public function addMessageEntity(ChatMessage $chatMessage): AzureOpenaiChatCompletionsApiRequest
    {
        $this->requestBody['messages'][] = $chatMessage->getProperties();
        return $this;
    }

    public function addMessageForUser(string $content): AzureOpenaiChatCompletionsApiRequest
    {
        return $this->addMessageForRole(ChatRole::ROLE_USER, $content);
    }

    public function addMessageForAssistant(string $content): AzureOpenaiChatCompletionsApiRequest
    {
        return $this->addMessageForRole(ChatRole::ROLE_ASSISTANT, $content);
    }

    /**
     * What sampling temperature to use, between 0 and 2.
     * Higher values like 0.8 will make the output more random,
     *  while lower values like 0.2 will make it more focused and deterministic.
     * We generally recommend altering this or top_p but not both.
     * @param float $temperature (0.0,2.0)
     */
    public function setTemperature(float $temperature): AzureOpenaiChatCompletionsApiRequest
    {
        $this->requestBody['temperature'] = $temperature;
        return $this;
    }

    /**
     * How many chat completion choices to generate for each input message.
     * @param int $n
     */
    public function setN(int $n): AzureOpenaiChatCompletionsApiRequest
    {
        $this->requestBody['n'] = $n;
        return $this;
    }

    /**
     * If set, partial message deltas will be sent, like in ChatGPT.
     * Tokens will be sent as data-only server-sent events as they become available,
     *  with the stream terminated by a data: [DONE] message."
     */
    public function setStream(bool $stream): AzureOpenaiChatCompletionsApiRequest
    {
        $this->requestBody['stream'] = $stream;
        return $this;
    }

    /**
     * Up to 4 sequences where the API will stop generating further tokens.
     * @param string|string[]|null $stop
     */
    public function setStop($stop): AzureOpenaiChatCompletionsApiRequest
    {
        $this->requestBody['stop'] = $stop;
        return $this;
    }

    /**
     * The maximum number of tokens allowed for the generated answer.
     * By default, the number of tokens the model can return will be (4096 - prompt tokens).
     */
    public function setMaxTokens(int $max_tokens): AzureOpenaiChatCompletionsApiRequest
    {
        $this->requestBody['max_tokens'] = $max_tokens;
        return $this;
    }

    /**
     * Number between -2.0 and 2.0.
     * Positive values penalize new tokens based on whether they appear in the text so far,
     *  increasing the model's likelihood to talk about new topics.
     */
    public function setPresencePenalty(float $presence_penalty): AzureOpenaiChatCompletionsApiRequest
    {
        $this->requestBody['presence_penalty'] = $presence_penalty;
        return $this;
    }

    /**
     * Number between -2.0 and 2.0.
     * Positive values penalize new tokens based on their existing frequency in the text so far,
     *  decreasing the model's likelihood to repeat the same line verbatim.
     */
    public function setFrequencyPenalty(float $frequency_penalty): AzureOpenaiChatCompletionsApiRequest
    {
        $this->requestBody['frequency_penalty'] = $frequency_penalty;
        return $this;
    }

    /**
     * Modify the likelihood of specified tokens appearing in the completion.
     * Accepts a json object that maps tokens (specified by their token ID in the tokenizer)
     *  to an associated bias value from -100 to 100.
     * Mathematically, the bias is added to the logits generated by the model prior to sampling.
     * The exact effect will vary per model,
     *  but values between -1 and 1 should decrease or increase likelihood of selection;
     *  values like -100 or 100 should result in a ban or exclusive selection of the relevant token.
     */
    public function setLogitBias(array $logit_bias): AzureOpenaiChatCompletionsApiRequest
    {
        $this->requestBody['logit_bias'] = $logit_bias;
        return $this;
    }

    /**
     * A unique identifier representing your end-user, which can help Azure OpenAI to monitor and detect abuse.
     * @param string|null $user
     * @return $this
     */
    public function setUser(string $user): AzureOpenaiChatCompletionsApiRequest
    {
        $this->requestBody['user'] = $user;
        return $this;
    }

    /**
     * Controls how the model responds to function calls.
     * "none" means the model does not call a function, and responds to the end-user.
     * "auto" means the model can pick between an end-user or calling a function.
     * Specifying a particular function via {"name": "my_function"} forces the model to call that function.
     * "none" is the default when no functions are present.
     * "auto" is the default if functions are present.
     * This parameter requires API version `2023-07-01-preview`.
     * @param ChatFunctionCall|string $function_call
     */
    public function setFunctionCall($function_call): AzureOpenaiChatCompletionsApiRequest
    {
        if ($function_call instanceof ChatFunctionCall) {
            $this->requestBody['function_call'] = $function_call->getProperties();
        } else {
            $this->requestBody['function_call'] = $function_call;
        }
        return $this;
    }

    /**
     * A list of functions the model can generate JSON inputs for.
     * This parameter requires API version 2023-07-01-preview
     * @param ChatFunctionDefinition[] $functions
     * @return $this
     */
    public function setFunctions(array $functions): AzureOpenaiChatCompletionsApiRequest
    {
        $list = [];
        foreach ($functions as $f) {
            $list[] = $f->getProperties();
        }
        $this->requestBody['functions'] = $list;
        return $this;
    }
}