<?php

namespace ConsulConfigManager\Users\Test\Unit\Commands;

use Illuminate\Support\Arr;

/**
 * Class CreateUserCommandTest
 *
 * @package ConsulConfigManager\Users\Test\Unit\Commands
 */
class CreateUserCommandTest extends AbstractCommandTest
{
    /**
     * @param array $data
     * @dataProvider dataProvider
     */
    public function testConsoleCommandSuccessful(array $data): void
    {
        $this->artisan('user:create')
            ->expectsQuestion('Please provide First Name for a new user', Arr::get($data, 'first_name'))
            ->expectsQuestion('Please provide Last Name for a new user', Arr::get($data, 'last_name'))
            ->expectsQuestion('Please provide E-Mail for a new user', Arr::get($data, 'email'))
            ->expectsQuestion('Please provide Username for a new user', Arr::get($data, 'username'))
            ->expectsQuestion('Please provide Password for a new user', Arr::get($data, 'password'))
            ->expectsQuestion('Please confirm Password for a new user', Arr::get($data, 'password'))
            ->expectsQuestion('Which role would you like to assign to user', Arr::get($data, 'role'))
            ->expectsOutput(sprintf(
                'Successfully created new user `%s %s <%s>`.',
                Arr::get($data, 'last_name'),
                Arr::get($data, 'first_name'),
                Arr::get($data, 'email')
            ))
            ->assertExitCode(0);
    }

    /**
     * @param array $data
     * @dataProvider dataProvider
     */
    public function testConsoleCommandSuccessfulWithMismatchedPasswords(array $data): void
    {
        $this->artisan('user:create')
            ->expectsQuestion('Please provide First Name for a new user', Arr::get($data, 'first_name'))
            ->expectsQuestion('Please provide Last Name for a new user', Arr::get($data, 'last_name'))
            ->expectsQuestion('Please provide E-Mail for a new user', Arr::get($data, 'email'))
            ->expectsQuestion('Please provide Username for a new user', Arr::get($data, 'username'))
            ->expectsQuestion('Please provide Password for a new user', Arr::get($data, 'password'))
            ->expectsQuestion('Please confirm Password for a new user', '12345678')
            ->expectsQuestion('Please provide Password for a new user', Arr::get($data, 'password'))
            ->expectsQuestion('Please confirm Password for a new user', Arr::get($data, 'password'))
            ->expectsQuestion('Which role would you like to assign to user', Arr::get($data, 'role'))
            ->expectsOutput(sprintf(
                'Successfully created new user `%s %s <%s>`.',
                Arr::get($data, 'last_name'),
                Arr::get($data, 'first_name'),
                Arr::get($data, 'email')
            ))
            ->assertExitCode(0);
    }

    /**
     * @param array $data
     * @dataProvider dataProvider
     */
    public function testConsoleCommandSuccessfulWithInvalidRole(array $data): void
    {
        $this->artisan('user:create')
            ->expectsQuestion('Please provide First Name for a new user', Arr::get($data, 'first_name'))
            ->expectsQuestion('Please provide Last Name for a new user', Arr::get($data, 'last_name'))
            ->expectsQuestion('Please provide E-Mail for a new user', Arr::get($data, 'email'))
            ->expectsQuestion('Please provide Username for a new user', Arr::get($data, 'username'))
            ->expectsQuestion('Please provide Password for a new user', Arr::get($data, 'password'))
            ->expectsQuestion('Please confirm Password for a new user', Arr::get($data, 'password'))
            ->expectsQuestion('Which role would you like to assign to user', 'invalid_role')
            ->expectsQuestion('Which role would you like to assign to user', Arr::get($data, 'role'))
            ->expectsOutput(sprintf(
                'Successfully created new user `%s %s <%s>`.',
                Arr::get($data, 'last_name'),
                Arr::get($data, 'first_name'),
                Arr::get($data, 'email')
            ))
            ->assertExitCode(0);
    }

    /**
     * @param array $data
     * @dataProvider dataProvider
     */
    public function testConsoleCommandUserExists(array $data): void
    {
        $this->createUserEntity($data);
        $this->artisan('user:create')
            ->expectsQuestion('Please provide First Name for a new user', Arr::get($data, 'first_name'))
            ->expectsQuestion('Please provide Last Name for a new user', Arr::get($data, 'last_name'))
            ->expectsQuestion('Please provide E-Mail for a new user', Arr::get($data, 'email'))
            ->expectsQuestion('Please provide Username for a new user', Arr::get($data, 'username'))
            ->expectsQuestion('Please provide Password for a new user', Arr::get($data, 'password'))
            ->expectsQuestion('Please confirm Password for a new user', Arr::get($data, 'password'))
            ->expectsQuestion('Which role would you like to assign to user', Arr::get($data, 'role'))
            ->expectsOutput(sprintf(
                'User `%s %s <%s>` already exists.',
                Arr::get($data, 'last_name'),
                Arr::get($data, 'first_name'),
                Arr::get($data, 'email')
            ))
            ->assertExitCode(1);
    }
}
