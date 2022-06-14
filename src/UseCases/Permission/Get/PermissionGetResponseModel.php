<?php

namespace ConsulConfigManager\Users\UseCases\Permission\Get;

use Spatie\Permission\Contracts\Permission;

/**
 * Class PermissionGetResponseModel
 * @package ConsulConfigManager\Users\UseCases\Permission\Get
 */
class PermissionGetResponseModel
{
    /**
     * Entity instance
     * @var Permission|array|null
     */
    private Permission|array|null $entity;

    /**
     * PermissionGetResponseModel constructor.
     * @param Permission|array|null $entity
     * @return void
     */
    public function __construct(Permission|array|null $entity = null)
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
