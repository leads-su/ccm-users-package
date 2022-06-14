<?php

namespace ConsulConfigManager\Users\Presenters\Permission;

use Throwable;
use Illuminate\Http\Response;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use ConsulConfigManager\Domain\ViewModels\HttpResponseViewModel;
use ConsulConfigManager\Users\UseCases\Permission\Create\PermissionCreateOutputPort;
use ConsulConfigManager\Users\UseCases\Permission\Create\PermissionCreateResponseModel;

/**
 * Class PermissionCreateHttpPresenter
 * @package ConsulConfigManager\Users\Presenters\Permission
 */
class PermissionCreateHttpPresenter implements PermissionCreateOutputPort
{
    /**
     * @inheritDoc
     */
    public function create(PermissionCreateResponseModel $responseModel): ViewModel
    {
        return new HttpResponseViewModel(response_success(
            $responseModel->getEntity(),
            'Successfully created new permission',
            Response::HTTP_CREATED,
        ));
    }

    /**
     * @inheritDoc
     */
    public function alreadyExists(PermissionCreateResponseModel $responseModel): ViewModel
    {
        return new HttpResponseViewModel(response_error(
            [],
            'Permission with provided name already exists',
            Response::HTTP_BAD_REQUEST
        ));
    }

    // @codeCoverageIgnoreStart
    /**
     * @inheritDoc
     */
    public function internalServerError(PermissionCreateResponseModel $responseModel, Throwable $throwable): ViewModel
    {
        if (config('app.debug')) {
            throw $throwable;
        }

        return new HttpResponseViewModel(response_error(
            $throwable,
            'Failed to create new permission',
            Response::HTTP_INTERNAL_SERVER_ERROR,
        ));
    }

    // @codeCoverageIgnoreEnd
}
