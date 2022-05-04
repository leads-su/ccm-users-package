<?php

namespace ConsulConfigManager\Users\UseCases\Role\Update;

use Spatie\Permission\Contracts\Role;

/**
 * Class RoleUpdateResponseModel
 * @package ConsulConfigManager\Users\UseCases\Role\Update
 */
class RoleUpdateResponseModel
{
    /**
     * Entity instance
     * @var Role|array|null
     */
    private Role|array|null $entity;

    /**
     * RoleUpdateResponseModel constructor.
     * @param Role|array|null $entity
     * @return void
     */
    public function __construct(Role|array|null $entity = null)
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
