<?php

namespace ConsulConfigManager\Users\Test\Unit\Commands;

use Illuminate\Support\Arr;
use ConsulConfigManager\Users\Test\TestCase;
use ConsulConfigManager\Users\Factories\UserFactory;
use ConsulConfigManager\Users\Interfaces\UserInterface;
use ConsulConfigManager\Users\ValueObjects\PasswordValueObject;
use ConsulConfigManager\Users\Interfaces\UserRepositoryInterface;

/**
 * Class AbstractCommandTest
 * @package ConsulConfigManager\Users\Test\Unit\Commands
 */
abstract class AbstractCommandTest extends TestCase
{
    /**
     * Create new user repository instance
     * @return UserRepositoryInterface
     */
    private function userRepository(): UserRepositoryInterface
    {
        return $this->app->make(UserRepositoryInterface::class);
    }

    /**
     * Create new user entity
     * @param array $data
     * @return UserInterface
     */
    protected function createUserEntity(array $data): UserInterface
    {
        $passwordObject = new PasswordValueObject(Arr::get($data, 'password'));
        $userObject = UserFactory::new()->make($data);

        return $this->userRepository()->create($userObject, $passwordObject);
    }

    /**
     * Data provide
     * @return \array[][]
     */
    public function dataProvider(): array
    {
        return [
            'example_user_entity'       =>  [
                'data'                  =>  [
                    'id'                =>  1,
                    'guid'              =>  '60f57a6e-41f9-48b1-b429-e938715927a5',
                    'domain'            =>  'example',
                    'first_name'        =>  'John',
                    'last_name'         =>  'Doe',
                    'username'          =>  'john.doe',
                    'email'             =>  'john.doe@example.com',
                    'password'          =>  'Examp1ePassw0rd',
                    'role'              =>  'guest',
                ],
            ],
        ];
    }
}
