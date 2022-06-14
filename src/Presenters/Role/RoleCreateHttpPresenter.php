<?php

namespace ConsulConfigManager\Users\Presenters\Role;

use Throwable;
use Illuminate\Http\Response;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use ConsulConfigManager\Domain\ViewModels\HttpResponseViewModel;
use ConsulConfigManager\Users\UseCases\Role\Create\RoleCreateOutputPort;
use ConsulConfigManager\Users\UseCases\Role\Create\RoleCreateResponseModel;

/**
 * Class RoleCreateHttpPresenter
 * @package ConsulConfigManager\Users\Presenters\Role
 */
class RoleCreateHttpPresenter implements RoleCreateOutputPort
{
    /**
     * @inheritDoc
     */
    public function create(RoleCreateResponseModel $responseModel): ViewModel
    {
        return new HttpResponseViewModel(response_success(
            $responseModel->getEntity(),
            'Successfully created new role',
            Response::HTTP_CREATED,
        ));
    }

    /**
     * @inheritDoc
     */
    public function alreadyExists(RoleCreateResponseModel $responseModel): ViewModel
    {
        return new HttpResponseViewModel(response_error(
            [],
            'Role with provided name already exists',
            Response::HTTP_BAD_REQUEST
        ));
    }

    // @codeCoverageIgnoreStart
    /**
     * @inheritDoc
     */
    public function internalServerError(RoleCreateResponseModel $responseModel, Throwable $throwable): ViewModel
    {
        if (config('app.debug')) {
            throw $throwable;
        }

        return new HttpResponseViewModel(response_error(
            $throwable,
            'Failed to create new role',
            Response::HTTP_INTERNAL_SERVER_ERROR,
        ));
    }

    // @codeCoverageIgnoreEnd
}
