<?php

namespace ConsulConfigManager\Users\Repositories;

use ConsulConfigManager\Users\Models\User;
use Illuminate\Database\Eloquent\Collection;
use ConsulConfigManager\Users\Interfaces\UserInterface;
use ConsulConfigManager\Users\ValueObjects\EmailValueObject;
use ConsulConfigManager\Users\ValueObjects\PasswordValueObject;
use ConsulConfigManager\Users\ValueObjects\UsernameValueObject;
use ConsulConfigManager\Users\Interfaces\UserRepositoryInterface;
use ConsulConfigManager\Users\Exceptions\ValueObjectNotUsedException;

/**
 * Class UserRepository
 * @package ConsulConfigManager\Users\Repositories
 */
class UserRepository implements UserRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function all(array $columns = ['*']): Collection
    {
        return User::all($columns);
    }

    /**
     * @inheritDoc
     */
    public function find(int $id, array $columns = ['*']): ?UserInterface
    {
        return User::find($id, $columns);
    }

    /**
     * @inheritDoc
     */
    public function findBy(string $field, mixed $value, array $columns = ['*']): ?UserInterface
    {
        if ($field === 'username') {
            throw new ValueObjectNotUsedException('Please use `findByUsername` method.');
        }
        if ($field === 'email') {
            throw new ValueObjectNotUsedException('Please use `findByEmail` method.');
        }
        return User::where($field, '=', $value)->first($columns);
    }

    /**
     * @inheritDoc
     */
    public function findByEmail(EmailValueObject $emailValueObject, array $columns = ['*']): ?UserInterface
    {
        return User::where('email', '=', (string) $emailValueObject)->first($columns);
    }

    /**
     * @inheritDoc
     */
    public function findByUsername(UsernameValueObject $usernameValueObject, array $columns = ['*']): ?UserInterface
    {
        return User::where('username', '=', (string) $usernameValueObject)->first($columns);
    }

    /**
     * @inheritDoc
     */
    public function exists(UserInterface $userEntity): bool
    {
        return User::where([
            'email'     =>  (string) $userEntity->getEmail(),
            'username'  =>  (string) $userEntity->getUsername(),
        ])->exists();
    }

    /**
     * @inheritDoc
     */
    public function create(UserInterface $userEntity, PasswordValueObject $passwordValueObject): UserInterface
    {
        return User::create([
            'guid'          =>  $userEntity->getGuid(),
            'domain'        =>  $userEntity->getDomain(),
            'first_name'    =>  $userEntity->getFirstName(),
            'last_name'     =>  $userEntity->getLastName(),
            'username'      =>  $userEntity->getUsername(),
            'email'         =>  $userEntity->getEmail(),
            'password'      =>  $passwordValueObject,
        ]);
    }

    /**
     * @inheritDoc
     */
    public function delete(UserInterface $userEntity): bool
    {
        return User::where('email', '=', $userEntity->getEmail())
            ->where('username', '=', $userEntity->getUsername())
            ->delete();
    }

    /**
     * @inheritDoc
     */
    public function update(int $userID, UserInterface $userEntity): UserInterface
    {
        $this->find($userID)->update([
            'first_name'    =>  $userEntity->getFirstName(),
            'last_name'     =>  $userEntity->getLastName(),
            'username'      =>  $userEntity->getUsername(),
            'email'         =>  $userEntity->getEmail(),
        ]);
        return $this->find($userID);
    }

    /**
     * @inheritDoc
     */
    public function withRole(string $roleName): Collection
    {
        return User::role($roleName)->get();
    }

    /**
     * @inheritDoc
     */
    public function withPermission(string $permissionName): Collection
    {
        return User::permission($permissionName)->get();
    }
}
