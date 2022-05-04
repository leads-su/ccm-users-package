<?php

namespace ConsulConfigManager\Users\Test\Unit\Commands;

use Illuminate\Support\Arr;
use Illuminate\Testing\PendingCommand;

/**
 * Class DeleteUserCommandTest
 *
 * @package ConsulConfigManager\Users\Test\Unit\Commands
 */
class DeleteUserCommandTest extends AbstractCommandTest
{
    /**
     * @return void
     */
    public function testConsoleCommandUserNotFound(): void
    {
        $this->artisan('user:delete')
            ->expectsQuestion('Please provide E-Mail or Username of the user you want to delete', 'unknown.user')
            ->assertExitCode(1);
    }

    /**
     * @param array $data
     * @dataProvider dataProvider
     */
    public function testConsoleCommandWithEmail(array $data): void
    {
        $this->createUserEntity($data);
        $command = $this->artisan('user:delete')
            ->expectsQuestion('Please provide E-Mail or Username of the user you want to delete', Arr::get($data, 'email'));
        $this->finalizeCommand($command, $data);
    }

    /**
     * @param array $data
     * @dataProvider dataProvider
     */
    public function testConsoleCommandWithUsername(array $data): void
    {
        $this->createUserEntity($data);
        $command = $this->artisan('user:delete')
            ->expectsQuestion('Please provide E-Mail or Username of the user you want to delete', Arr::get($data, 'username'));
        $this->finalizeCommand($command, $data);
    }

    /**
     * Finalize command (execute it and assert output)
     * @param PendingCommand $command
     * @param array          $data
     */
    private function finalizeCommand(PendingCommand $command, array $data): void
    {
        $command->expectsChoice('Are you sure you want to delete this user', 'y', ['y', 'n'])
            ->expectsOutput(sprintf(
                'Successfully deleted user `%s %s <%s>`.',
                Arr::get($data, 'last_name'),
                Arr::get($data, 'first_name'),
                Arr::get($data, 'email')
            ))
            ->assertExitCode(0);
    }
}
