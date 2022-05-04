<?php

namespace ConsulConfigManager\Users\Presenters\User;

use Throwable;
use Illuminate\Console\Command;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use ConsulConfigManager\Domain\ViewModels\CLIViewModel;
use ConsulConfigManager\Users\UseCases\User\Update\UserUpdateOutputPort;
use ConsulConfigManager\Users\UseCases\User\Update\UserUpdateRequestModel;
use ConsulConfigManager\Users\UseCases\User\Update\UserUpdateResponseModel;

/**
 * Class UserUpdateCLIPresenter
 * @package ConsulConfigManager\Users\Presenters\User
 */
class UserUpdateCLIPresenter implements UserUpdateOutputPort
{
    // @codeCoverageIgnoreStart
    /**
     * @inheritDoc
     */
    public function update(UserUpdateResponseModel $updateUserResponseModel): ViewModel
    {
        return new CLIViewModel(function (Command $command) use ($updateUserResponseModel): int {
            $user = $updateUserResponseModel->getUpdatedUser();
            $command->info(sprintf(
                'Successfully updated user `%s %s <%s>`.',
                $user->getLastName(),
                $user->getFirstName(),
                (string) $user->getEmail()
            ));
            return Command::SUCCESS;
        });
    }
    // @codeCoverageIgnoreEnd

    // @codeCoverageIgnoreStart
    /**
     * @inheritDoc
     */
    public function notFound(UserUpdateRequestModel $updateUserRequestModel): ViewModel
    {
        return new CLIViewModel(function (Command $command) use ($updateUserRequestModel): int {
            $command->error(sprintf(
                'User with ID %d was not found.',
                $updateUserRequestModel->getID()
            ));
            return Command::FAILURE;
        });
    }
    // @codeCoverageIgnoreEnd

    // @codeCoverageIgnoreStart
    /**
     * @inheritDoc
     */
    public function internalServerError(UserUpdateResponseModel $updateUserResponseModel, Throwable $exception): ViewModel
    {
        return new CLIViewModel(function (Command $command) use ($exception): int {
            $command->error(sprintf(
                'Error occurred while updating user: `%s`',
                $exception->getMessage()
            ));
            return Command::FAILURE;
        });
    }
    // @codeCoverageIgnoreEnd
}
