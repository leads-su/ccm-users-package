<?php

namespace ConsulConfigManager\Users\Presenters\User;

use Throwable;
use function config;
use function response_error;
use function response_success;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use ConsulConfigManager\Domain\ViewModels\HttpResponseViewModel;
use ConsulConfigManager\Users\UseCases\User\Delete\UserDeleteOutputPort;
use ConsulConfigManager\Users\UseCases\User\Delete\UserDeleteRequestModel;
use ConsulConfigManager\Users\UseCases\User\Delete\UserDeleteResponseModel;

/**
 * Class UserDeleteHttpPresenter
 * @package ConsulConfigManager\Users\Presenters\User
 */
class UserDeleteHttpPresenter implements UserDeleteOutputPort
{
    /**
     * @inheritDoc
     */
    public function delete(UserDeleteResponseModel $deleteUserResponseModel): ViewModel
    {
        return new HttpResponseViewModel(
            response_success(
                $deleteUserResponseModel->getDeletedUser(),
                'Successfully deleted user'
            )
        );
    }

    /**
     * @inheritDoc
     */
    public function notFound(UserDeleteRequestModel $deleteRequestModel): ViewModel
    {
        return new HttpResponseViewModel(
            response_error(
                [],
                sprintf('User with ID %d was not found.', $deleteRequestModel->getID()),
            )
        );
    }

    // @codeCoverageIgnoreStart
    /**
     * @inheritDoc
     */
    public function internalServerError(UserDeleteResponseModel $deleteUserResponseModel, Throwable $exception): ViewModel
    {
        if (config('app.debug')) {
            throw $exception;
        }
        return new HttpResponseViewModel(
            response_error(
                $exception,
                'Unable to delete user'
            )
        );
    }
    // @codeCoverageIgnoreEnd
}
