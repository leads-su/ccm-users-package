<?php

namespace ConsulConfigManager\Users\Presenters\User;

use Throwable;
use Illuminate\Console\Command;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use ConsulConfigManager\Domain\ViewModels\CLIViewModel;
use ConsulConfigManager\Users\UseCases\User\Create\UserCreateOutputPort;
use ConsulConfigManager\Users\UseCases\User\Create\UserCreateResponseModel;

/**
 * Class UserCreateCLIPresenter
 * @package ConsulConfigManager\Users\Presenters\User
 */
class UserCreateCLIPresenter implements UserCreateOutputPort
{
    /**
     * @inheritDoc
     */
    public function create(UserCreateResponseModel $createUserResponseModel): ViewModel
    {
        return new CLIViewModel(function (Command $command) use ($createUserResponseModel): int {
            $user = $createUserResponseModel->getUser();
            $command->info(sprintf(
                'Successfully created new user `%s %s <%s>`.',
                $user->getLastName(),
                $user->getFirstName(),
                (string) $user->getEmail()
            ));
            return Command::SUCCESS;
        });
    }

    /**
     * @inheritDoc
     */
    public function alreadyExists(UserCreateResponseModel $createUserResponseModel): ViewModel
    {
        return new CLIViewModel(function (Command $command) use ($createUserResponseModel): int {
            $user = $createUserResponseModel->getUser();
            $command->error(sprintf(
                'User `%s %s <%s>` already exists.',
                $user->getLastName(),
                $user->getFirstName(),
                (string) $user->getEmail()
            ));
            return Command::FAILURE;
        });
    }

    // @codeCoverageIgnoreStart
    /**
     * @inheritDoc
     */
    public function internalServerError(UserCreateResponseModel $responseModel, Throwable $exception): ViewModel
    {
        return new CLIViewModel(function (Command $command) use ($exception): int {
            $command->error(sprintf(
                'Error occurred while creating user: `%s`',
                $exception->getMessage()
            ));
            return Command::FAILURE;
        });
    }
    // @codeCoverageIgnoreEnd
}
