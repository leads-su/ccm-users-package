<?php

namespace ConsulConfigManager\Users\UseCases\Permission\Update;

use Spatie\Permission\Contracts\Permission;

/**
 * Class PermissionUpdateResponseModel
 * @package ConsulConfigManager\Users\UseCases\Permission\Update
 */
class PermissionUpdateResponseModel
{
    /**
     * Entity instance
     * @var Permission|array|null
     */
    private Permission|array|null $entity;

    /**
     * PermissionUpdateResponseModel constructor.
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
