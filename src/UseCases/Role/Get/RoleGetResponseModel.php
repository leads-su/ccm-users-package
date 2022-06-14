<?php

namespace ConsulConfigManager\Users\UseCases\Role\Get;

use Spatie\Permission\Contracts\Role;

/**
 * Class RoleGetResponseModel
 * @package ConsulConfigManager\Users\UseCases\Role\Get
 */
class RoleGetResponseModel
{
    /**
     * Entity instance
     * @var Role|array|null
     */
    private Role|array|null $entity;

    /**
     * RoleGetResponseModel constructor.
     * @param Role|array|null $entity
     * @return void
     */
    public function __construct(Role|array|null $entity = null)
    {
        $this->entity = $entity;
    }

    /**
     * Get entity as array
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
