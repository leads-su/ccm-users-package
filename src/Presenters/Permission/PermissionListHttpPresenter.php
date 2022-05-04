<?php

namespace ConsulConfigManager\Users\Presenters\Permission;

use Throwable;
use Illuminate\Http\Response;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use ConsulConfigManager\Domain\ViewModels\HttpResponseViewModel;
use ConsulConfigManager\Users\UseCases\Permission\List\PermissionListOutputPort;
use ConsulConfigManager\Users\UseCases\Permission\List\PermissionListResponseModel;

/**
 * Class PermissionListHttpPresenter
 * @package ConsulConfigManager\Users\Presenters\Permission
 */
class PermissionListHttpPresenter implements PermissionListOutputPort
{
    /**
     * @inheritDoc
     */
    public function list(PermissionListResponseModel $responseModel): ViewModel
    {
        return new HttpResponseViewModel(response_success(
            $responseModel->getEntities(),
            'Successfully fetched list of permissions',
            Response::HTTP_OK,
        ));
    }

    // @codeCoverageIgnoreStart
    /**
     * @inheritDoc
     */
    public function internalServerError(PermissionListResponseModel $responseModel, Throwable $throwable): ViewModel
    {
        if (config('app.debug')) {
            throw $throwable;
        }

        return new HttpResponseViewModel(response_error(
            $throwable,
            'Unable to retrieve permissions list',
            Response::HTTP_INTERNAL_SERVER_ERROR,
        ));
    }
    // @codeCoverageIgnoreEnd
}
