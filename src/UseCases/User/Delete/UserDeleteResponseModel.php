<?php

namespace ConsulConfigManager\Users\UseCases\User\Delete;

use ConsulConfigManager\Users\Interfaces\UserInterface;

/**
 * Class UserDeleteResponseModel
 *
 * @package ConsulConfigManager\Users\UseCases\User\Delete
 */
class UserDeleteResponseModel
{
    /**
     * User model instance
     * @var UserInterface|null
     */
    private ?UserInterface $userEntity;

    /**
     * DeleteUserResponseModel Constructor.
     *
     * @param UserInterface|null $userEntity
     */
    public function __construct(?UserInterface $userEntity = null)
    {
        $this->userEntity = $userEntity;
    }

    /**
     * Get deleted user
     * @return UserInterface|null
     */
    public function getDeletedUser(): ?UserInterface
    {
        return $this->userEntity;
    }
}
