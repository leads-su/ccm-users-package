<?php

namespace ConsulConfigManager\Users\Interfaces;

use Illuminate\Support\Collection;
use Spatie\Permission\Models\Role;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Contracts\Support\Arrayable;
use Laravel\Sanctum\Contracts\HasAbilities;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use ConsulConfigManager\Users\ValueObjects\EmailValueObject;
use ConsulConfigManager\Users\ValueObjects\PasswordValueObject;
use ConsulConfigManager\Users\ValueObjects\UsernameValueObject;
use ConsulConfigManager\Users\ValueObjects\HashedPasswordValueObject;

/**
 * Interface UserInterface
 * @package ConsulConfigManager\Users\Interfaces
 */
interface UserInterface extends Arrayable
{
    /**
     * Get id
     * @return int
     */
    public function getID(): int;

    /**
     * Set id
     * @param int $id
     * @return UserInterface
     */
    public function setID(int $id): UserInterface;

    /**
     * Get AD guid
     * @return string|null
     */
    public function getGuid(): ?string;

    /**
     * Set AD guid
     * @param string $guid
     * @return UserInterface
     */
    public function setGuid(string $guid): UserInterface;

    /**
     * Get AD domain
     * @return string|null
     */
    public function getDomain(): ?string;

    /**
     * Set AD domain
     * @param string $domain
     * @return UserInterface
     */
    public function setDomain(string $domain): UserInterface;

    /**
     * Get first name
     * @return string
     */
    public function getFirstName(): string;

    /**
     * Set first name
     * @param string $firstName
     *
     * @return UserInterface
     */
    public function setFirstName(string $firstName): UserInterface;

    /**
     * Get last name
     * @return string
     */
    public function getLastName(): string;

    /**
     * Set last name
     * @param string $lastName
     *
     * @return UserInterface
     */
    public function setLastName(string $lastName): UserInterface;

    /**
     * Get username
     * @return UsernameValueObject
     */
    public function getUsername(): UsernameValueObject;

    /**
     * Set username
     * @param UsernameValueObject $usernameValueObject
     *
     * @return UserInterface
     */
    public function setUsername(UsernameValueObject $usernameValueObject): UserInterface;

    /**
     * Get e-mail
     * @return EmailValueObject
     */
    public function getEmail(): EmailValueObject;

    /**
     * Set e-mail
     * @param EmailValueObject $emailValueObject
     *
     * @return UserInterface
     */
    public function setEmail(EmailValueObject $emailValueObject): UserInterface;

    /**
     * Get password
     * @return HashedPasswordValueObject
     */
    public function getPassword(): HashedPasswordValueObject;

    /**
     * Set password
     * @param PasswordValueObject $passwordValueObject
     *
     * @return UserInterface
     */
    public function setPassword(PasswordValueObject $passwordValueObject): UserInterface;

    /**
     * Return formatted e-mail as Laravel Model attribute
     * @return EmailValueObject
     */
    public function getEmailAttribute(): EmailValueObject;

    /**
     * Set Laravel Model e-mail attribute from value object
     * @param EmailValueObject|string $emailValueObject
     * @return UserInterface
     */
    public function setEmailAttribute(EmailValueObject|string $emailValueObject): UserInterface;

    /**
     * Return formatted username as Laravel Model attribute
     * @return UsernameValueObject
     */
    public function getUsernameAttribute(): UsernameValueObject;

    /**
     * Set Laravel Model username attribute from value object
     * @param UsernameValueObject|string $usernameValueObject
     * @return UserInterface
     */
    public function setUsernameAttribute(UsernameValueObject|string $usernameValueObject): UserInterface;

    /**
     * Return formatted password as Laravel Model attribute
     * @return HashedPasswordValueObject
     */
    public function getPasswordAttribute(): HashedPasswordValueObject;

    /**
     * Set Laravel Model password attribute from value object
     * @param PasswordValueObject|string $passwordValueObject
     * @return UserInterface
     */
    public function setPasswordAttribute(PasswordValueObject|string $passwordValueObject): UserInterface;

    /**
     * Assign the given role to the model.
     *
     * @param array|string|int|Role ...$roles
     *
     * @return $this
     */
    public function assignRole(...$roles);

    /**
     * Revoke the given role from the model.
     *
     * @param string|int|Role $role
     *
     * @return $this
     */
    public function removeRole($role);

    /**
     * Determine if the model has (one of) the given role(s).
     *
     * @param string|int|array|Role|Collection $roles
     * @param string|null $guard
     * @return bool
     */
    public function hasRole($roles, string $guard = null): bool;

    /**
     * Determine if the model has any of the given role(s).
     *
     * Alias to hasRole() but without Guard controls
     *
     * @param string|int|array|Role|Collection $roles
     *
     * @return bool
     */
    public function hasAnyRole(...$roles): bool;

    /**
     * Determine if the model has all of the given role(s).
     *
     * @param  string|array|Role|Collection  $roles
     * @param  string|null  $guard
     * @return bool
     */
    public function hasAllRoles($roles, string $guard = null): bool;

    /**
     * Determine if the model has exactly all of the given role(s).
     *
     * @param  string|array|Role|Collection  $roles
     * @param  string|null  $guard
     * @return bool
     */
    public function hasExactRoles($roles, string $guard = null): bool;

    /**
     * Return all permissions directly coupled to the model.
     * @return Collection
     */
    public function getDirectPermissions(): Collection;

    /**
     * Return names of roles attached to model.
     * @return Collection
     */
    public function getRoleNames(): Collection;

    /**
     * Get list of permissions attached to user
     * @return array
     */
    public function getScopesAttribute(): array;

    /**
     * Get role attached to model
     * @return string
     */
    public function getRoleAttribute(): string;

    /**
     * Get total number of roles associated with user
     * @return int
     */
    public function getRolesCountAttribute(): int;

    /**
     * Get total number of permissions associated with user
     * @return int
     */
    public function getPermissionsCountAttribute(): int;

    /**
     * Append attributes to query when building a query.
     *
     * @param  array|string  $attributes
     * @return $this
     */
    public function append($attributes);

    /**
     * Get a subset of the model's attributes.
     *
     * @param  array|mixed  $attributes
     * @return array
     */
    public function only($attributes);

    /**
     * Get the access token currently associated with the user.
     *
     * @return PersonalAccessToken|HasAbilities
     */
    public function currentAccessToken();

    /**
     * Get the access tokens that belong to model.
     *
     * @return MorphMany
     */
    public function tokens();
}
