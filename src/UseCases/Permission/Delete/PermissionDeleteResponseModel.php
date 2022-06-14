<?php

namespace ConsulConfigManager\Users\UseCases\Permission\Delete;

use Spatie\Permission\Contracts\Permission;

/**
 * Class PermissionDeleteResponseModel
 * @package ConsulConfigManager\Users\UseCases\Permission\Delete
 */
class PermissionDeleteResponseModel
{
    /**
     * Entity instance
     * @var Permission|array|null
     */
    private Permission|array|null $entity;

    /**
     * PermissionDeleteResponseModel constructor.
     * @param Permission|array|null $entity
     * @return void
     */
    public function __construct(Permission|array|null $entity = null)
    {
        $this->entity = $entity;
    }

    /**
     * Delete entity as array
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
