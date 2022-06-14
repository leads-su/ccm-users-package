<?php

namespace ConsulConfigManager\Users\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use ConsulConfigManager\Users\ValueObjects\EmailValueObject;
use ConsulConfigManager\Users\ValueObjects\PasswordValueObject;
use ConsulConfigManager\Users\ValueObjects\UsernameValueObject;
use ConsulConfigManager\Users\Exceptions\ValueObjectNotUsedException;

/**
 * Interface UserRepositoryInterface
 * @package ConsulConfigManager\Users\Interfaces
 */
interface UserRepositoryInterface
{
    /**
     * Get list of all users from database
     * @param array|string[] $columns
     *
     * @return Collection<UserInterface>
     */
    public function all(array $columns = ['*']): Collection;

    /**
     * Find user by id
     * @param int            $id
     * @param array|string[] $columns
     *
     * @return UserInterface|null
     */
    public function find(int $id, array $columns = ['*']): ?UserInterface;

    /**
     * Find user by specified field and value
     * @param string         $field
     * @param mixed          $value
     * @param array|string[] $columns
     *
     * @throws ValueObjectNotUsedException
     * @return UserInterface|null
     */
    public function findBy(string $field, mixed $value, array $columns = ['*']): ?UserInterface;

    /**
     * Find user by e-mail
     *
     * @param EmailValueObject $emailValueObject
     * @param array            $columns
     *
     * @return UserInterface|null
     */
    public function findByEmail(EmailValueObject $emailValueObject, array $columns = ['*']): ?UserInterface;

    /**
     * Find user by username
     *
     * @param UsernameValueObject $usernameValueObject
     * @param array               $columns
     *
     * @return UserInterface|null
     */
    public function findByUsername(UsernameValueObject $usernameValueObject, array $columns = ['*']): ?UserInterface;

    /**
     * Check whether user already exists in the database
     * @param UserInterface $userEntity
     *
     * @return bool
     */
    public function exists(UserInterface $userEntity): bool;

    /**
     * Create new user from specified parameters
     * @param UserInterface          $userEntity
     * @param PasswordValueObject $passwordValueObject
     *
     * @return UserInterface
     */
    public function create(UserInterface $userEntity, PasswordValueObject $passwordValueObject): UserInterface;

    /**
     * Delete existing user
     * @param UserInterface $userEntity
     *
     * @return bool
     */
    public function delete(UserInterface $userEntity): bool;

    /**
     * Update existing User
     *
     * @param int        $userID
     * @param UserInterface $userEntity
     *
     * @return UserInterface
     */
    public function update(int $userID, UserInterface $userEntity): UserInterface;

    /**
     * Get users who have specified role
     * @param string $roleName
     * @return Collection
     */
    public function withRole(string $roleName): Collection;

    /**
     * Get users who have specified permission
     * @param string $permissionName
     * @return Collection
     */
    public function withPermission(string $permissionName): Collection;
}
