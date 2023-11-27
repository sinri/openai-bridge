<?php

namespace sinri\openai\bridge\azure\chat\completion;

use sinri\openai\bridge\core\AbstractEntity;

/**
 * The name and arguments of a function that should be called,
 *  as generated by the model.
 * This requires API version `2023-07-01-preview`.
 * @property string name The name of the function to call.
 * @property string arguments The arguments to call the function with, as generated by the model in JSON format. Note that the model does not always generate valid JSON, and might fabricate parameters not defined by your function schema. Validate the arguments in your code before calling your function.
 */
class ChatFunctionCall extends AbstractEntity
{
    public function __construct(string $name, string $arguments)
    {
        parent::__construct([
            'name' => $name,
            'arguments' => $arguments
        ]);
    }
}