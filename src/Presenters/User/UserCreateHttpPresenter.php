<?php

namespace ConsulConfigManager\Users\Presenters\User;

use Throwable;
use function config;
use function response_error;
use Illuminate\Http\Response;
use function response_success;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use ConsulConfigManager\Domain\ViewModels\HttpResponseViewModel;
use ConsulConfigManager\Users\UseCases\User\Create\UserCreateOutputPort;
use ConsulConfigManager\Users\UseCases\User\Create\UserCreateResponseModel;

/**
 * Class UserCreateHttpPresenter
 * @package ConsulConfigManager\Users\Presenters\User
 */
class UserCreateHttpPresenter implements UserCreateOutputPort
{
    /**
     * @inheritDoc
     */
    public function create(UserCreateResponseModel $createUserResponseModel): ViewModel
    {
        return new HttpResponseViewModel(
            response_success(
                $createUserResponseModel->getUser(),
                'Successfully created new user',
                Response::HTTP_CREATED
            )
        );
    }

    /**
     * @inheritDoc
     */
    public function alreadyExists(UserCreateResponseModel $createUserResponseModel): ViewModel
    {
        return new HttpResponseViewModel(
            response_error(
                [],
                sprintf('User %s already exists', $createUserResponseModel->getUser()->getEmail()),
                Response::HTTP_FOUND
            )
        );
    }

    // @codeCoverageIgnoreStart
    /**
     * @inheritDoc
     */
    public function internalServerError(UserCreateResponseModel $responseModel, Throwable $exception): ViewModel
    {
        if (config('app.debug')) {
            throw $exception;
        }
        return new HttpResponseViewModel(
            response_error(
                $exception,
                'Unable to create new user'
            )
        );
    }
    // @codeCoverageIgnoreEnd
}
