<?php

namespace ConsulConfigManager\Users\Database\Seeders;

use Illuminate\Database\Seeder;
use ConsulConfigManager\Users\Models\User;
use ConsulConfigManager\Users\Interfaces\UserInterface;
use ConsulConfigManager\Users\ValueObjects\EmailValueObject;
use Illuminate\Contracts\Container\BindingResolutionException;
use ConsulConfigManager\Users\ValueObjects\PasswordValueObject;
use ConsulConfigManager\Users\ValueObjects\UsernameValueObject;
use ConsulConfigManager\Users\Interfaces\UserRepositoryInterface;
use ConsulConfigManager\Users\ValueObjects\HashedPasswordValueObject;

/**
 * Class SystemUserSeeder
 * @package ConsulConfigManager\Users\Database\Seeders
 */
class SystemUserSeeder extends Seeder
{
    /**
     * First name for user
     * @var string
     */
    private string $firstName = 'User';

    /**
     * Last name for user
     * @var string
     */
    private string $lastName = 'System';

    /**
     * Username for user
     * @var string
     */
    private string $username = 'system';

    /**
     * E-Mail for user
     * @var string
     */
    private string $email = 'admin@leads.su';

    /**
     * Password for user
     * @var string
     */
    private string $password = '$Super$Strong#User#Password$#';

    /**
     * Run the database seeds.
     * @return void
     * @throws BindingResolutionException
     */
    public function run(): void
    {
        $repository = $this->repository();
        if (!$repository->findByEmail($this->email())) {
            $model = $this->repository()->create($this->user(), $this->password());
            $model->assignRole('administrator');
        }
    }

    /**
     * Convert string representation of username to corresponding value object
     * @return UsernameValueObject
     */
    private function username(): UsernameValueObject
    {
        return new UsernameValueObject($this->username);
    }

    /**
     * Convert string representation of email to corresponding value object
     * @return EmailValueObject
     */
    private function email(): EmailValueObject
    {
        return new EmailValueObject($this->email);
    }

    /**
     * Convert string representation of password to corresponding value object
     * @return PasswordValueObject
     */
    private function password(): PasswordValueObject
    {
        return new PasswordValueObject($this->password);
    }

    /**
     * Convert password value object to hashed password value object
     * @return HashedPasswordValueObject
     */
    private function hashedPassword(): HashedPasswordValueObject
    {
        return $this->password()->hashed();
    }

    /**
     * Create new user
     * @return UserInterface
     */
    private function user(): UserInterface
    {
        $model = new User();
        $model->setFirstName($this->firstName);
        $model->setLastName($this->lastName);
        $model->setUsername($this->username());
        $model->setEmail($this->email());
        return $model;
    }

    /**
     * @return UserRepositoryInterface
     * @throws BindingResolutionException
     */
    private function repository(): UserRepositoryInterface
    {
        return app()->make(UserRepositoryInterface::class);
    }
}
