<?php

namespace ConsulConfigManager\Users\Commands;

use Illuminate\Support\Arr;
use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;
use ConsulConfigManager\Domain\ViewModels\CLIViewModel;
use ConsulConfigManager\Users\UseCases\User\Create\UserCreateInputPort;
use ConsulConfigManager\Users\UseCases\User\Create\UserCreateRequestModel;

/**
 * Class CreateUserCommand
 *
 * @package ConsulConfigManager\Users\Commands
 * @example php artisan user:create
 */
class CreateUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create new user';

    /**
     * Input port instance
     *
     * @var UserCreateInputPort
     */
    private UserCreateInputPort $interactor;

    /**
     * CreateUserCommand Constructor.
     *
     * @param UserCreateInputPort $interactor
     */
    public function __construct(UserCreateInputPort $interactor)
    {
        $this->interactor = $interactor;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $userData['first_name'] = $this->promptForFirstName();
        $userData['last_name'] = $this->promptForLastName();
        $userData['email'] = $this->promptForEMail();
        $userData['username'] = $this->promptForUsername($userData);
        $userData['password'] = $this->promptForPassword();
        $userData['role'] = $this->promptForRole();

        $viewModel = $this->interactor->create(new UserCreateRequestModel($userData));

        if ($viewModel instanceof CLIViewModel) {
            return $viewModel->handle($this);
        }

        // @codeCoverageIgnoreStart
        return self::SUCCESS;
        // @codeCoverageIgnoreEnd
    }

    /**
     * Prompt user for E-Mail
     * @return string
     */
    private function promptForEMail(): string
    {
        return trim($this->ask('Please provide E-Mail for a new user'));
    }

    /**
     * Prompt user for Username
     *
     * @param array $userData
     *
     * @return string
     */
    private function promptForUsername(array $userData): string
    {
        $usernameFromEmail = Arr::first(explode('@', Arr::get($userData, 'email')));
        return trim($this->ask('Please provide Username for a new user', $usernameFromEmail));
    }

    /**
     * Prompt user for First Name
     * @return string
     */
    private function promptForFirstName(): string
    {
        return trim($this->ask('Please provide First Name for a new user'));
    }

    /**
     * Prompt user for Last Name
     * @return string
     */
    private function promptForLastName(): string
    {
        return trim($this->ask('Please provide Last Name for a new user'));
    }

    /**
     * Prompt user for Password
     * @return string
     */
    private function promptForPassword(): string
    {
        $password = trim($this->secret('Please provide Password for a new user'));
        $passwordConfirmation = trim($this->secret('Please confirm Password for a new user'));

        if ($password !== $passwordConfirmation) {
            $this->warn('Provided passwords do not match!');
            return $this->promptForPassword();
        }
        return $password;
    }

    /**
     * Prompt for role
     * @param bool $changing
     *
     * @return string
     */
    private function promptForRole(bool $changing = false): string
    {
        $databaseRoles = Arr::flatten(Role::all('name')->toArray());
        $roles = [];
        foreach ($databaseRoles as $role) {
            $roles[$role] = implode(' ', array_map(static function (string $value): string {
                return ucfirst(trim($value));
            }, explode('_', $role)));
        }
        $chosenRole = $this->choice('Which role would you like to assign to user', $roles, 'guest');

        $roleInstance = Role::where('name', '=', $chosenRole)->first();
        if (!$roleInstance) {
            $this->error('Unable to find role matching selected name');
            return $this->promptForRole($changing);
        }
        return $roleInstance->name;
    }
}
