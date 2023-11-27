<?php

namespace sinri\openai\bridge\openai\v1\model;

use sinri\openai\bridge\core\AbstractEntity;

/**
 * @property-read array data
 */
class ModelsEntity extends AbstractEntity
{
    public function __construct(array $array)
    {
        parent::__construct($array);
        $this->assetObjectType("list");
    }

    public function getTotalModels(): int
    {
        return count($this->data);
    }

    public function getModelAt(int $index): ModelEntity
    {
        return new ModelEntity($this->data[$index]);
    }
}