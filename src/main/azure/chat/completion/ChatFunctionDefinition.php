<?php

namespace sinri\openai\bridge\azure\chat\completion;

use sinri\openai\bridge\core\AbstractEntity;

/**
 * @property string name The name of the function to be called.
 * @property string description A description of what the function does. The model will use this description when selecting the function and interpreting its parameters.
 * @property string parameters The parameters the functions accepts, described as a JSON Schema object.
 */
class ChatFunctionDefinition extends AbstractEntity
{
    public function __construct(string $name, string $description, ChatFunctionDefinitionParameters $parameters)
    {
        parent::__construct([
            'name' => $name,
            'description' => $description,
            'parameters' => $parameters->toArray(),
        ]);
    }
}