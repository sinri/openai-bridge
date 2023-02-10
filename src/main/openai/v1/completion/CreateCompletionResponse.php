<?php

namespace sinri\openai\bridge\openai\v1\completion;

use sinri\openai\bridge\openai\AbstractEntity;

/**
 * @property-read string id
 * @property-read int created
 * @property-read string model
 * @property-read  array[] $choices
 * @property-read  array $usage
 */
class CreateCompletionResponse extends AbstractEntity
{
    /**
     * @var CreateCompletionResponseChoice[]
     */
    private array $choiceEntities = [];

    public function __construct(array $array)
    {
        parent::__construct($array);
        $this->assetObjectType("text_completion");
        foreach ($this->choices as $b) {
            $this->choiceEntities[] = new CreateCompletionResponseChoice($b);
        }
    }

    /**
     * @return CreateCompletionResponseChoice[]
     */
    public function getChoiceEntities(): array
    {

        return $this->choiceEntities;
    }

    public function getUsageEntity(): CreateCompletionResponseUsage
    {
        return new CreateCompletionResponseUsage($this->usage);
    }
}