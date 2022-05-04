<?php

namespace ConsulConfigManager\Users\UseCases\Role\Create;

use Spatie\Permission\Contracts\Role;

/**
 * Class RoleCreateResponseModel
 * @package ConsulConfigManager\Users\UseCases\Role\Create
 */
class RoleCreateResponseModel
{
    /**
     * Entity instance
     * @var Role|array|null
     */
    private Role|array|null $entity;

    /**
     * RoleCreateResponseModel constructor.
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
