<?php

namespace ConsulConfigManager\Users\UseCases\Role\Delete;

use Spatie\Permission\Contracts\Role;

/**
 * Class RoleDeleteResponseModel
 * @package ConsulConfigManager\Users\UseCases\Role\Delete
 */
class RoleDeleteResponseModel
{
    /**
     * Entity instance
     * @var Role|array|null
     */
    private Role|array|null $entity;

    /**
     * RoleDeleteResponseModel constructor.
     * @param Role|array|null $entity
     * @return void
     */
    public function __construct(Role|array|null $entity = null)
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
