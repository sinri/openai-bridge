<?php

namespace sinri\openai\bridge\azure\embedding;

use sinri\openai\bridge\core\AbstractEntity;

/**
 * @property-read string object "list"
 * @property-read array data
 * @property-read string model
 */
class EmbeddingResponse extends AbstractEntity
{
    /**
     * @return EmbeddingResponseDatum[]
     */
    public function getDatumList(): array
    {
        $datumList = [];
        foreach ($this->data as $datum) {
            $datumList[] = new EmbeddingResponseDatum($datum);
        }
        return $datumList;
    }
}