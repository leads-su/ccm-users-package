<?php

namespace ConsulConfigManager\Users\Presenters\Permission;

use Throwable;
use Illuminate\Http\Response;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use ConsulConfigManager\Domain\ViewModels\HttpResponseViewModel;
use ConsulConfigManager\Users\UseCases\Permission\Update\PermissionUpdateOutputPort;
use ConsulConfigManager\Users\UseCases\Permission\Update\PermissionUpdateResponseModel;

/**
 * Class PermissionUpdateHttpPresenter
 * @package ConsulConfigManager\Users\Presenters\Permission
 */
class PermissionUpdateHttpPresenter implements PermissionUpdateOutputPort
{
    /**
     * @inheritDoc
     */
    public function update(PermissionUpdateResponseModel $responseModel): ViewModel
    {
        return new HttpResponseViewModel(response_success(
            $responseModel->getEntity(),
            'Successfully updated permission',
            Response::HTTP_OK,
        ));
    }

    /**
     * @inheritDoc
     */
    public function notFound(PermissionUpdateResponseModel $responseModel): ViewModel
    {
        return new HttpResponseViewModel(response_error(
            [],
            'Unable to find requested permission'
        ));
    }

    // @codeCoverageIgnoreStart

    /**
     * @inheritDoc
     */
    public function internalServerError(PermissionUpdateResponseModel $responseModel, Throwable $throwable): ViewModel
    {
        if (config('app.debug')) {
            throw $throwable;
        }

        return new HttpResponseViewModel(response_error(
            $throwable,
            'Unable to update permission',
            Response::HTTP_INTERNAL_SERVER_ERROR,
        ));
    }

    // @codeCoverageIgnoreEnd
}
