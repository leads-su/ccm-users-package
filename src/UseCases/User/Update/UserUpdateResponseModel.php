<?php

namespace ConsulConfigManager\Users\UseCases\User\Update;

use ConsulConfigManager\Users\Interfaces\UserInterface;

/**
 * Class UserUpdateResponseModel
 *
 * @package ConsulConfigManager\Users\UseCases\User\Update
 */
class UserUpdateResponseModel
{
    /**
     * User model instance
     * @var UserInterface
     */
    private UserInterface $userEntity;

    public function __construct(UserInterface $userEntity)
    {
        $this->userEntity = $userEntity;
    }

    /**
     * Get updated user
     * @return UserInterface
     */
    public function getUpdatedUser(): UserInterface
    {
        return $this->userEntity;
    }
}
