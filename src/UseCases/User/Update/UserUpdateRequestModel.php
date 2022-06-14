<?php

namespace ConsulConfigManager\Users\UseCases\User\Update;

use Illuminate\Support\Arr;

/**
 * Class UserUpdateRequestModel
 *
 * @package ConsulConfigManager\Users\UseCases\User\Update
 */
class UserUpdateRequestModel
{
    /**
     * Model attributes
     * @var array
     */
    private array $attributes = [];

    /**
     * UpdateUserRequestModel Constructor.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes)
    {
        $this->attributes = $attributes;
    }

    /**
     * Get user id
     * @return int
     */
    public function getID(): int
    {
        return Arr::get($this->attributes, 'id');
    }

    /**
     * Get first name
     * @return string
     */
    public function getFirstName(): string
    {
        return Arr::get($this->attributes, 'first_name', '');
    }

    /**
     * Get last name
     * @return string
     */
    public function getLastName(): string
    {
        return Arr::get($this->attributes, 'last_name', '');
    }

    /**
     * Get username
     * @return string
     */
    public function getUsername(): string
    {
        return Arr::get($this->attributes, 'username', '');
    }

    /**
     * Get e-mail
     * @return string
     */
    public function getEmail(): string
    {
        return Arr::get($this->attributes, 'email', '');
    }

    /**
     * Get password
     * @return string
     */
    public function getPassword(): string
    {
        return Arr::get($this->attributes, 'password', '');
    }

    /**
     * Get role
     * @return string
     */
    public function getRole(): string
    {
        return Arr::get($this->attributes, 'role', config('domain.users.default_role'));
    }
}
