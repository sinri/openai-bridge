<?php

namespace sinri\openai\bridge\openai\v1\model;

use sinri\openai\bridge\core\AbstractEntity;

/**
 * @property-read string id
 * @property-read string object
 * @property-read int created
 * @property-read bool allow_create_engine
 * @property-read bool allow_sampling
 * @property-read bool allow_logprobs
 * @property-read bool allow_search_indices
 * @property-read bool allow_view
 * @property-read bool allow_fine_tuning
 * @property-read string organization
 * @property-read mixed|null group
 * @property-read bool is_blocking
 */
class ModelPermissionEntity extends AbstractEntity
{
    public function __construct(?array $array = null)
    {
        parent::__construct($array);
        $this->assetObjectType("model_permission");
    }
    //          "id": "modelperm-49FUp5v084tBB49tC4z8LPH5",
    //          "object": "model_permission",
    //          "created": 1669085501,
    //          "allow_create_engine": false,
    //          "allow_sampling": true,
    //          "allow_logprobs": true,
    //          "allow_search_indices": false,
    //          "allow_view": true,
    //          "allow_fine_tuning": false,
    //          "organization": "*",
    //          "group": null,
    //          "is_blocking": false
}