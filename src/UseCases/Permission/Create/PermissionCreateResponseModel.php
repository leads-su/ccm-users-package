<?php

namespace ConsulConfigManager\Users\UseCases\Permission\Create;

use Spatie\Permission\Contracts\Permission;

/**
 * Class PermissionCreateResponseModel
 * @package ConsulConfigManager\Users\UseCases\Permission\Create
 */
class PermissionCreateResponseModel
{
    /**
     * Entity instance
     * @var Permission|array|null
     */
    private Permission|array|null $entity;

    /**
     * PermissionCreateResponseModel constructor.
     * @param Permission|array|null $entity
     * @return void
     */
    public function __construct(Permission|array|null $entity = null)
    {
        $this->entity = $entity;
    }

    /**
     * Get entity
     * @return array
     */
    public function getEntity(): array
    {
        if (is_null($this->entity)) {
            return [];
        } elseif (is_array($this->entity)) {
            return $this->entity;
        }
        return $this->entity->toArray();
    }
}
