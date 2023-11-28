<?php

namespace sinri\openai\bridge\azure\chat\completion;

class ChatFunctionDefinitionParameters
{
    private array $properties;
    private array $required;

    public function __construct()
    {
        $this->properties = [];
        $this->required = [];
//        parent::__construct([
//            'type' => 'object',
//            'properties' => [],
//            'required' => [],
//        ]);
    }

    /**
     * @param string $name
     * @param string $type string or number
     * @param string $description
     * @param bool $required
     * @return $this
     */
    public function addParameter(string $name, string $type, string $description, bool $required): ChatFunctionDefinitionParameters
    {
        $this->properties[$name] = [
            'type' => $type,
            'description' => $description,
        ];
        if ($required) {
            $this->required[] = $name;
        }
        return $this;
    }

    public function toArray(): array
    {
        return [
            'type' => 'object',
            'properties' => $this->properties,
            'required' => $this->required,
        ];
    }
}