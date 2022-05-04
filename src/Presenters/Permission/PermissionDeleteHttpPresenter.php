<?php

namespace ConsulConfigManager\Users\Presenters\Permission;

use Throwable;
use Illuminate\Http\Response;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use ConsulConfigManager\Domain\ViewModels\HttpResponseViewModel;
use ConsulConfigManager\Users\UseCases\Permission\Delete\PermissionDeleteOutputPort;
use ConsulConfigManager\Users\UseCases\Permission\Delete\PermissionDeleteResponseModel;

/**
 * Class PermissionDeleteHttpPresenter
 * @package ConsulConfigManager\Users\Presenters\Permission
 */
class PermissionDeleteHttpPresenter implements PermissionDeleteOutputPort
{
    /**
     * @inheritDoc
     */
    public function delete(PermissionDeleteResponseModel $responseModel): ViewModel
    {
        return new HttpResponseViewModel(response_success(
            $responseModel->getEntity(),
            'Successfully deleted permission',
            Response::HTTP_OK,
        ));
    }

    /**
     * @inheritDoc
     */
    public function notFound(PermissionDeleteResponseModel $responseModel): ViewModel
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
    public function internalServerError(PermissionDeleteResponseModel $responseModel, Throwable $throwable): ViewModel
    {
        if (config('app.debug')) {
            throw $throwable;
        }

        return new HttpResponseViewModel(response_error(
            $throwable,
            'Unable to delete permission',
            Response::HTTP_INTERNAL_SERVER_ERROR,
        ));
    }
    // @codeCoverageIgnoreEnd
}
