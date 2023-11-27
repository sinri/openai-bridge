<?php

namespace sinri\openai\bridge\openai\v1\completion;

use sinri\openai\bridge\core\AbstractEntity;

/**
 * @property-read string id
 * @property-read int created
 * @property-read string model
 * @property-read  array[] $choices
 * @property-read  array $usage
 */
class CompletionResultEntity extends AbstractEntity
{
    /**
     * @var CompletionChoiceEntity[]
     */
    private array $choiceEntities = [];

    public function __construct(array $array)
    {
        parent::__construct($array);
        $this->assetObjectType("text_completion");
        foreach ($this->choices as $b) {
            $this->choiceEntities[] = new CompletionChoiceEntity($b);
        }
    }

    /**
     * @return CompletionChoiceEntity[]
     */
    public function getChoiceEntities(): array
    {

        return $this->choiceEntities;
    }

    public function getUsageEntity(): CompletionUsageEntity
    {
        return new CompletionUsageEntity($this->usage);
    }
}