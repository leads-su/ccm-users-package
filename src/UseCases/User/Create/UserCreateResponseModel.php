<?php

namespace ConsulConfigManager\Users\UseCases\User\Create;

use ConsulConfigManager\Users\Interfaces\UserInterface;

/**
 * Class UserCreateResponseModel
 *
 * @package ConsulConfigManager\Users\UseCases\User\Create
 */
class UserCreateResponseModel
{
    /**
     * User model instance
     * @var UserInterface
     */
    private UserInterface $userEntity;

    /**
     * CreateUserResponseModel Constructor.
     *
     * @param UserInterface $userEntity
     */
    public function __construct(UserInterface $userEntity)
    {
        $this->userEntity = $userEntity;
    }

    /**
     * Get user
     * @return UserInterface
     */
    public function getUser(): UserInterface
    {
        return $this->userEntity;
    }
}
