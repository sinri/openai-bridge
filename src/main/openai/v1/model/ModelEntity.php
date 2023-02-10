<?php

namespace sinri\openai\bridge\openai\v1\model;

use sinri\openai\bridge\openai\AbstractEntity;

/**
 * @property-read string id
 * @property-read string object
 * @property-read int created
 * @property-read string owned_by
 * @property-read string root
 * @property-read mixed|null parent
 * @property-read array permission
 */
class ModelEntity extends AbstractEntity
{
    /**
     * @var ModelPermissionEntity[]
     */
    private array $permissionEntityList = [];

    public function __construct(?array $array = null)
    {
        parent::__construct($array);
        $this->assetObjectType("model");
        foreach ($this->permission as $p) {
            $this->permissionEntityList[] = new ModelPermissionEntity($p);
        }
    }

    /**
     * @return ModelPermissionEntity[]
     */
    public function getPermissionEntityList(): array
    {
        return $this->permissionEntityList;
    }

    // "id": "babbage",
    //      "object": "model",
    //      "created": 1649358449,
    //      "owned_by": "openai",
    //      "permission": [
    //        {
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
    //        }
    //      ],
    //      "root": "babbage",
    //      "parent": null
}