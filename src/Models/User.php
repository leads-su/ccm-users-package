<?php

namespace ConsulConfigManager\Users\Models;

use Illuminate\Support\Arr;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Auth\Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Passwords\CanResetPassword;
use LdapRecord\Laravel\Auth\AuthenticatesWithLdap;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Auth\Access\Authorizable;
use ConsulConfigManager\Users\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use ConsulConfigManager\Users\Interfaces\UserInterface;
use ConsulConfigManager\Users\ValueObjects\EmailValueObject;
use ConsulConfigManager\Users\ValueObjects\PasswordValueObject;
use ConsulConfigManager\Users\ValueObjects\UsernameValueObject;
use ConsulConfigManager\Users\ValueObjects\HashedPasswordValueObject;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

/**
 * Class User
 *
 * @package ConsulConfigManager\Users\Models
 */
class User extends Model implements UserInterface, AuthorizableContract, AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable;
    use AuthenticatesWithLdap;
    use Authorizable;
    use CanResetPassword;
    use HasFactory;
    use HasApiTokens;
    use HasRoles;
    use Notifiable;

    /**
     * Guard used for model
     * @var string
     */
    protected string $guard_name = 'api';

    /**
     * @inheritDoc
     */
    protected $fillable = [
        'id',
        'guid',
        'domain',
        'first_name',
        'last_name',
        'username',
        'email',
        'password',
    ];

    /**
     * @inheritDoc
     */
    protected $hidden = [
        'roles',
        'permissions',
        'password',
        'remember_token',
    ];

    /**
     * @inheritDoc
     */
    protected $casts = [];

    /**
     * @inheritDoc
     */
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * @inheritDoc
     */
    protected $appends = [];

    /**
     * @inheritDoc
     */
    protected static function newFactory(): Factory
    {
        return UserFactory::new();
    }

    /**
     * @inheritDoc
     */
    public function getID(): int
    {
        return $this->attributes['id'];
    }

    /**
     * @inheritDoc
     */
    public function setID(int $id): UserInterface
    {
        $this->attributes['id'] = $id;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getGuid(): ?string
    {
        if (isset($this->attributes['guid'])) {
            return $this->attributes['guid'];
        }
        return null;
    }

    /**
     * @inheritDoc
     */
    public function setGuid(string $guid): UserInterface
    {
        $this->attributes['guid'] = $guid;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getDomain(): ?string
    {
        if (isset($this->attributes['domain'])) {
            return $this->attributes['domain'];
        }
        return null;
    }

    /**
     * @inheritDoc
     */
    public function setDomain(string $domain): UserInterface
    {
        $this->attributes['domain'] = $domain;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getFirstName(): string
    {
        return $this->attributes['first_name'];
    }

    /**
     * @inheritDoc
     */
    public function setFirstName(string $firstName): UserInterface
    {
        $this->attributes['first_name'] = $firstName;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getLastName(): string
    {
        return $this->attributes['last_name'];
    }

    /**
     * @inheritDoc
     */
    public function setLastName(string $lastName): UserInterface
    {
        $this->attributes['last_name'] = $lastName;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getEmail(): EmailValueObject
    {
        return new EmailValueObject($this->attributes['email']);
    }

    /**
     * @inheritDoc
     */
    public function setEmail(EmailValueObject $emailValueObject): UserInterface
    {
        $this->attributes['email'] = (string) $emailValueObject;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getUsername(): UsernameValueObject
    {
        return new UsernameValueObject($this->attributes['username']);
    }

    /**
     * @inheritDoc
     */
    public function setUsername(UsernameValueObject $usernameValueObject): UserInterface
    {
        $this->attributes['username'] = (string) $usernameValueObject;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getPassword(): HashedPasswordValueObject
    {
        return new HashedPasswordValueObject($this->attributes['password']);
    }

    /**
     * @inheritDoc
     */
    public function setPassword(PasswordValueObject $passwordValueObject): UserInterface
    {
        $this->attributes['password'] = (string) $passwordValueObject->hashed();
        return $this;
    }

    /**
     * Return formatted e-mail as Laravel Model attribute
     * @return EmailValueObject
     */
    public function getEmailAttribute(): EmailValueObject
    {
        return new EmailValueObject($this->attributes['email']);
    }

    /**
     * Set Laravel Model e-mail attribute from value object
     * @param EmailValueObject|string $emailValueObject
     * @return UserInterface
     */
    public function setEmailAttribute(EmailValueObject|string $emailValueObject): UserInterface
    {
        if (is_string($emailValueObject)) {
            $emailValueObject = new EmailValueObject($emailValueObject);
        }
        $this->setEmail($emailValueObject);
        return $this;
    }

    /**
     * Return formatted username as Laravel Model attribute
     * @return UsernameValueObject
     */
    public function getUsernameAttribute(): UsernameValueObject
    {
        return new UsernameValueObject($this->attributes['username']);
    }

    /**
     * Set Laravel Model username attribute from value object
     * @param UsernameValueObject|string $usernameValueObject
     * @return UserInterface
     */
    public function setUsernameAttribute(UsernameValueObject|string $usernameValueObject): UserInterface
    {
        if (is_string($usernameValueObject)) {
            $usernameValueObject = new UsernameValueObject($usernameValueObject);
        }
        $this->setUsername($usernameValueObject);
        return $this;
    }

    /**
     * Return formatted password as Laravel Model attribute
     * @return HashedPasswordValueObject
     */
    public function getPasswordAttribute(): HashedPasswordValueObject
    {
        // @codeCoverageIgnoreStart
        if (!isset($this->attributes['password'])) {
            $password = (new PasswordValueObject("nonExistentPassword"))->hashed();
        } else {
            // @codeCoverageIgnoreEnd
            $password = $this->attributes['password'];
        }
        return new HashedPasswordValueObject($password);
    }

    /**
     * Set Laravel Model password attribute from value object
     * @param PasswordValueObject|string $passwordValueObject
     * @return UserInterface
     */
    public function setPasswordAttribute(PasswordValueObject|string $passwordValueObject): UserInterface
    {
        if (is_string($passwordValueObject)) {
            $passwordValueObject = new PasswordValueObject($passwordValueObject);
        }
        $this->setPassword($passwordValueObject);
        return $this;
    }

    /**
     * Get list of permissions attached to user
     * @return array
     */
    public function getScopesAttribute(): array
    {
        return array_map(static function (array $permission): string {
            return Arr::get($permission, 'name');
        }, $this->getPermissionsViaRoles()->toArray());
    }

    /**
     * Get role attached to model
     * @return string
     */
    public function getRoleAttribute(): string
    {
        $role = $this->roles()->first(['name']);
        if (!$role) {
            return config('domain.users.default_role');
        }
        return $role->name;
    }

    /**
     * Get total number of roles associated with user
     * @return int
     */
    public function getRolesCountAttribute(): int
    {
        return $this->roles()->count();
    }

    /**
     * Get total number of permissions associated with user
     * @return int
     */
    public function getPermissionsCountAttribute(): int
    {
        return $this->getPermissionsViaRoles()->count();
    }
}
