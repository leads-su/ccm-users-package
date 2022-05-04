<?php

namespace ConsulConfigManager\Users\Presenters\User;

use Throwable;
use Illuminate\Console\Command;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use ConsulConfigManager\Domain\ViewModels\CLIViewModel;
use ConsulConfigManager\Users\UseCases\User\Delete\UserDeleteOutputPort;
use ConsulConfigManager\Users\UseCases\User\Delete\UserDeleteRequestModel;
use ConsulConfigManager\Users\UseCases\User\Delete\UserDeleteResponseModel;

/**
 * Class UserDeleteCLIPresenter
 * @package ConsulConfigManager\Users\Presenters\User
 */
class UserDeleteCLIPresenter implements UserDeleteOutputPort
{
    /**
     * @inheritDoc
     */
    public function delete(UserDeleteResponseModel $deleteUserResponseModel): ViewModel
    {
        return new CLIViewModel(function (Command $command) use ($deleteUserResponseModel): int {
            $user = $deleteUserResponseModel->getDeletedUser();
            $command->info(sprintf(
                'Successfully deleted user `%s %s <%s>`.',
                $user->getLastName(),
                $user->getFirstName(),
                (string) $user->getEmail()
            ));
            return Command::SUCCESS;
        });
    }

    // @codeCoverageIgnoreStart
    /**
     * @inheritDoc
     */
    public function notFound(UserDeleteRequestModel $deleteUserRequestModel): ViewModel
    {
        return new CLIViewModel(function (Command $command) use ($deleteUserRequestModel): int {
            $command->error(sprintf(
                'User with ID %d was not found.',
                $deleteUserRequestModel->getID()
            ));
            return Command::FAILURE;
        });
    }
    // @codeCoverageIgnoreEnd

    // @codeCoverageIgnoreStart
    /**
     * @inheritDoc
     */
    public function internalServerError(UserDeleteResponseModel $deleteUserResponseModel, Throwable $exception): ViewModel
    {
        return new CLIViewModel(function (Command $command) use ($exception): int {
            $command->error(sprintf(
                'Error occurred while deleting user: `%s`',
                $exception->getMessage()
            ));
            return Command::FAILURE;
        });
    }
    // @codeCoverageIgnoreEnd
}
