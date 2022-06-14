<?php

namespace ConsulConfigManager\Users\UseCases\Token\Delete;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TokenDeleteResponseModel
 * @package ConsulConfigManager\Users\UseCases\Token\Delete
 */
class TokenDeleteResponseModel
{
    /**
     * Entity instance
     * @var Model|array
     */
    private Model|array $entity;

    /**
     * TokenDeleteResponseModel constructor.
     * @param Model|array $entity
     * @return void
     */
    public function __construct(Model|array $entity = [])
    {
        $this->entity = $entity;
    }

    /**
     * Get entity instance as array
     * @return array
     */
    public function getEntity(): array
    {
        if ($this->entity instanceof Model) {
            return $this->entity->toArray();
        }
        return $this->entity;
    }
}
