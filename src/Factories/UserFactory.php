<?php

namespace ConsulConfigManager\Users\Factories;

use Illuminate\Database\Eloquent\Model;
use ConsulConfigManager\Users\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use ConsulConfigManager\Users\Interfaces\UserInterface;
use ConsulConfigManager\Users\ValueObjects\EmailValueObject;
use ConsulConfigManager\Users\Interfaces\UserFactoryInterface;
use ConsulConfigManager\Users\ValueObjects\PasswordValueObject;
use ConsulConfigManager\Users\ValueObjects\UsernameValueObject;

/**
 * Class UserFactory
 * @package ConsulConfigManager\Users\Factories
 */
class UserFactory extends Factory implements UserFactoryInterface
{
    /**
     * @inheritDoc
     */
    protected $model = User::class;

    /**
     * @inheritDoc
     */
    public function definition(): array
    {
        return [
            'id'                =>  $this->faker->numberBetween(1, 10),
            'guid'              =>  null,
            'domain'            =>  null,
            'first_name'        =>  $this->faker->firstName(),
            'last_name'         =>  $this->faker->lastName(),
            'username'          =>  $this->faker->userName(),
            'email'             =>  $this->faker->email(),
//            'password'          =>  $this->faker->password(8, 32),
        ];
    }

    /**
     * @inheritDoc
     */
    public function make($attributes = [], ?Model $parent = null): Model|UserInterface|null
    {
        if (isset($attributes['email']) && is_string($attributes['email'])) {
            $attributes['email'] = new EmailValueObject($attributes['email']);
        }

        if (isset($attributes['username']) && is_string($attributes['username'])) {
            $attributes['username'] = new UsernameValueObject($attributes['username']);
        }

        if (isset($attributes['password']) && is_string($attributes['password'])) {
            $attributes['password'] = new PasswordValueObject($attributes['password']);
        }

        return parent::make($attributes, $parent);
    }
}
