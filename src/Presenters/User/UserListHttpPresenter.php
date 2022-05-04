<?php

namespace ConsulConfigManager\Users\Presenters\User;

use Throwable;
use Illuminate\Http\Response;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use ConsulConfigManager\Domain\ViewModels\HttpResponseViewModel;
use ConsulConfigManager\Users\UseCases\User\List\UserListOutputPort;
use ConsulConfigManager\Users\UseCases\User\List\UserListResponseModel;

/**
 * Class UserListHttpPresenter
 * @package ConsulConfigManager\Users\Presenters\User
 */
class UserListHttpPresenter implements UserListOutputPort
{
    /**
     * @inheritDoc
     */
    public function list(UserListResponseModel $responseModel): ViewModel
    {
        return new HttpResponseViewModel(response_success(
            $responseModel->getEntities(),
            'Successfully fetched list of users',
            Response::HTTP_OK,
        ));
    }

    // @codeCoverageIgnoreStart
    /**
     * @inheritDoc
     */
    public function internalServerError(UserListResponseModel $responseModel, Throwable $throwable): ViewModel
    {
        if (config('app.debug')) {
            throw $throwable;
        }

        return new HttpResponseViewModel(response_error(
            $throwable,
            'Unable to retrieve users list',
            Response::HTTP_INTERNAL_SERVER_ERROR,
        ));
    }
    // @codeCoverageIgnoreEnd
}
