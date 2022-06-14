<?php

namespace ConsulConfigManager\Users\UseCases\User\Get;

use ConsulConfigManager\Users\Interfaces\UserInterface;

/**
 * Class UserGetResponseModel
 * @package ConsulConfigManager\Users\UseCases\User\Get
 */
class UserGetResponseModel
{
    /**
     * Entity instance
     * @var UserInterface|array|null
     */
    private UserInterface|array|null $entity;

    /**
     * UserGetResponseModel constructor.
     * @param UserInterface|array|null $entity
     * @return void
     */
    public function __construct(UserInterface|array|null $entity = null)
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
