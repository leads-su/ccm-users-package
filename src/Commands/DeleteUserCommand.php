<?php

namespace ConsulConfigManager\Users\Commands;

use Illuminate\Console\Command;
use ConsulConfigManager\Domain\ViewModels\CLIViewModel;
use ConsulConfigManager\Users\ValueObjects\EmailValueObject;
use ConsulConfigManager\Users\ValueObjects\UsernameValueObject;
use ConsulConfigManager\Users\Interfaces\UserRepositoryInterface;
use ConsulConfigManager\Users\UseCases\User\Delete\UserDeleteInputPort;
use ConsulConfigManager\Users\UseCases\User\Delete\UserDeleteRequestModel;

/**
 * Class DeleteUserCommand
 *
 * @package ConsulConfigManager\Users\Commands
 * @example php artisan user:delete
 */
class DeleteUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete existing user';

    /**
     * Input port instance
     *
     * @var UserDeleteInputPort
     */
    private UserDeleteInputPort $interactor;

    /**
     * Repository instance
     * @var UserRepositoryInterface
     */
    private UserRepositoryInterface $repository;

    /**
     * DeleteUserCommand constructor.
     * @param UserDeleteInputPort $interactor
     * @param UserRepositoryInterface $repository
     * @return void
     */
    public function __construct(UserDeleteInputPort $interactor, UserRepositoryInterface $repository)
    {
        $this->interactor = $interactor;
        $this->repository = $repository;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $emailOrUsername = trim($this->ask('Please provide E-Mail or Username of the user you want to delete'));
        $userModel = str_contains($emailOrUsername, '@')
            ? $this->repository->findByEmail(new EmailValueObject($emailOrUsername))
            : $this->repository->findByUsername(new UsernameValueObject($emailOrUsername));

        if (!$userModel) {
            $this->error('Unable to find user with specified email/username');
            return Command::FAILURE;
        }

        if ($this->choice('Are you sure you want to delete this user', ['y', 'n'], 'y') === 'y') {
            $viewModel = $this->interactor->delete(new UserDeleteRequestModel($userModel->toArray()));

            if ($viewModel instanceof CLIViewModel) {
                return $viewModel->handle($this);
            }
        }

        // @codeCoverageIgnoreStart
        return Command::SUCCESS;
        // @codeCoverageIgnoreEnd
    }
}
