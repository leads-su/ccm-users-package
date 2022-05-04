<?php

namespace ConsulConfigManager\Users\Presenters\User;

use Throwable;
use function config;
use function response_error;
use function response_success;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use ConsulConfigManager\Domain\ViewModels\HttpResponseViewModel;
use ConsulConfigManager\Users\UseCases\User\Update\UserUpdateOutputPort;
use ConsulConfigManager\Users\UseCases\User\Update\UserUpdateRequestModel;
use ConsulConfigManager\Users\UseCases\User\Update\UserUpdateResponseModel;

/**
 * Class UserUpdateHttpPresenter
 * @package ConsulConfigManager\Users\Presenters\User
 */
class UserUpdateHttpPresenter implements UserUpdateOutputPort
{
    /**
     * @inheritDoc
     */
    public function update(UserUpdateResponseModel $updateUserResponseModel): ViewModel
    {
        return new HttpResponseViewModel(
            response_success(
                $updateUserResponseModel->getUpdatedUser(),
                'Successfully updated user'
            )
        );
    }

    /**
     * @inheritDoc
     */
    public function notFound(UserUpdateRequestModel $updateUserRequestModel): ViewModel
    {
        return new HttpResponseViewModel(
            response_error(
                [],
                sprintf('User with ID %d was not found.', $updateUserRequestModel->getID()),
            )
        );
    }

    // @codeCoverageIgnoreStart
    /**
     * @inheritDoc
     */
    public function internalServerError(UserUpdateResponseModel $updateUserResponseModel, Throwable $exception): ViewModel
    {
        if (config('app.debug')) {
            throw $exception;
        }
        return new HttpResponseViewModel(
            response_error(
                $exception,
                'Unable to update user'
            )
        );
    }
    // @codeCoverageIgnoreEnd
}
