<?php

namespace ConsulConfigManager\Users\UseCases\User\Delete;

use Illuminate\Support\Arr;

/**
 * Class UserDeleteRequestModel
 *
 * @package ConsulConfigManager\Users\UseCases\User\Delete
 */
class UserDeleteRequestModel
{
    /**
     * Model attributes
     * @var array
     */
    private array $attributes;

    /**
     * DeleteUserRequestModel Constructor.
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
     * Get role
     * @return string
     */
    public function getRole(): string
    {
        return Arr::get($this->attributes, 'role', config('domain.users.default_role'));
    }
}
