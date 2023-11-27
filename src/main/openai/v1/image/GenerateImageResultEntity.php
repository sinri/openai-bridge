<?php

namespace sinri\openai\bridge\openai\v1\image;

use sinri\openai\bridge\core\AbstractEntity;

/**
 * @property-read int created
 * @property-read array[] data
 */
class GenerateImageResultEntity extends AbstractEntity
{
    private array $imageUrls = [];

    public function __construct(?array $array = null)
    {
        parent::__construct($array);

        foreach ($this->data as $datum) {
            $this->imageUrls[] = $datum['url'];
        }
    }

    /**
     * @return string[]
     */
    public function getImageUrls(): array
    {
        return $this->imageUrls;
    }
}