<?php

namespace sinri\openai\bridge\core;

use RuntimeException;
use sinri\ark\core\ArkHelper;

/**
 * Entity is defined by properties and attach reader to it.
 * @property string $object list, model, text_completion
 */
class AbstractEntity
{
    private array $properties = [];

    public function __construct(?array $array = null)
    {
        if (is_array($array)) {
            $this->setProperties($array);
        }
    }

    /**
     * @param string $resp
     * @return static
     */
    public static function fromJsonString(string $resp)
    {
        $array = json_decode($resp, true);
        if (!is_array($array)) {
            throw new RuntimeException();
        }
        return new static($array);
    }

    /**
     * @return array
     */
    public function getProperties(): array
    {
        return $this->properties;
    }

    /**
     * @param array $properties
     */
    protected function setProperties(array $properties): void
    {
        $this->properties = $properties;
    }

    public function __get($name)
    {
        return ArkHelper::readTarget($this->properties, $name);
    }

    public function __set($name, $value)
    {
        $this->properties[$name] = $value;
    }

    public function __isset($name)
    {
        return isset($this->properties, $name);
    }

    public function assetObjectType(string $expected)
    {
        if ($this->object !== $expected) {
            throw new RuntimeException();
        }
    }
}