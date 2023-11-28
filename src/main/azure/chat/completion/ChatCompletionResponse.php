<?php

namespace sinri\openai\bridge\azure\chat\completion;

use sinri\openai\bridge\core\AbstractEntity;

/**
 * @property string id
 * @property string object
 * @property string model
 * @property array usage {"prompt_tokens":58, "completion_tokens":68, "total_tokens":126}
 * @property array[] choices
 */
class ChatCompletionResponse extends AbstractEntity
{
    /*
     {
        "id":"chatcmpl-6v7mkQj980V1yBec6ETrKPRqFjNw9",
        "object":"chat.completion","created":1679072642,
        "model":"gpt-35-turbo",
        "usage":{"prompt_tokens":58,"completion_tokens":68,"total_tokens":126},
        "choices":[
            {
                "message":{
                    "role":"assistant",
                    "content":"Yes, other Azure AI services also support customer managed keys. Azure AI services offer multiple options for customers to manage keys, such as using Azure Key Vault, customer-managed keys in Azure Key Vault or customer-managed keys through Azure Storage service. This helps customers ensure that their data is secure and access to their services is controlled."
                },
                "finish_reason":"stop",
                "index":0
            }
         ]
     }
     */

    /*
     {
        "id":"chatcmpl-8PiQgpZBGp65wxl0VEIjFCTwd5GKn",
        "object":"chat.completion",
        "created":1701139678,
        "model":"gpt-4",
        "prompt_filter_results":[
            {
                "prompt_index":0,
                "content_filter_results":{
                    "hate":{
                        "filtered":false,
                        "severity":"safe"
                    },
                    "self_harm":{"filtered":false,"severity":"safe"},
                    "sexual":{"filtered":false,"severity":"safe"},
                    "violence":{"filtered":false,"severity":"safe"}
                }
            }
        ],
        "choices":[
            {
                "index":0,
                "finish_reason":"function_call",
                "message":{
                    "role":"assistant",
                    "function_call":{
                        "name":"product_seek_func",
                        "arguments":"{\"keyword\":\"\\u5b89\\u5353\\u624b\\u673a\"}"
                    }
                },
                "content_filter_results":[]
            }
        ],
        "usage":{"prompt_tokens":120,"completion_tokens":28,"total_tokens":148},
        "system_fingerprint":"fp_50a4261de5"
    }
     */

    /**
     * @return ChatCompletionResponseUsage
     */
    public function getUsageEntity(): ChatCompletionResponseUsage
    {
        return new ChatCompletionResponseUsage($this->usage);
    }

    /**
     * @return ChatCompletionResponseChoice[]
     */
    public function getChoiceEntities(): array
    {
        $list = [];
        foreach ($this->choices as $choice) {
            $list[] = new ChatCompletionResponseChoice($choice);
        }
        return $list;
    }
}