<?php

namespace sinri\openai\bridge\azure\embedding;

use sinri\openai\bridge\azure\AzureOpenaiApiRequest;

class AzureOpenaiEmbeddingApiRequest extends AzureOpenaiApiRequest
{
    /**
     * @param string|string[] $input 获取嵌入的输入文本，编码为数组或字符串。 输入令牌的数量因所使用的模型而异。仅 text-embedding-ada-002 (Version 2) 支持数组输入。
     * @param string|null $user 表示最终用户的唯一标识符。 这将帮助 Azure OpenAI 监视和检测滥用行为。 不要传递 PII 标识符，而是使用伪名化值，例如 GUID
     * @return EmbeddingResponse
     */
    public function requestForEmbedding($input, ?string $user = null): EmbeddingResponse
    {
        $body = [
            "input" => $input,
        ];
        if ($user === null) {
            $body['user'] = $user;
        }
        $array = $this->callApi("embeddings", $body);
        return new EmbeddingResponse($array);
    }
}