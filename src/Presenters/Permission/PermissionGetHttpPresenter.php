<?php

namespace ConsulConfigManager\Users\Presenters\Permission;

use Throwable;
use Illuminate\Http\Response;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use ConsulConfigManager\Domain\ViewModels\HttpResponseViewModel;
use ConsulConfigManager\Users\UseCases\Permission\Get\PermissionGetOutputPort;
use ConsulConfigManager\Users\UseCases\Permission\Get\PermissionGetResponseModel;

/**
 * Class PermissionGetHttpPresenter
 * @package ConsulConfigManager\Users\Presenters\Permission
 */
class PermissionGetHttpPresenter implements PermissionGetOutputPort
{
    /**
     * @inheritDoc
     */
    public function get(PermissionGetResponseModel $responseModel): ViewModel
    {
        return new HttpResponseViewModel(response_success(
            $responseModel->getEntity(),
            'Successfully fetched permission information',
            Response::HTTP_OK,
        ));
    }

    /**
     * @inheritDoc
     */
    public function notFound(PermissionGetResponseModel $responseModel): ViewModel
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
    public function internalServerError(PermissionGetResponseModel $responseModel, Throwable $throwable): ViewModel
    {
        if (config('app.debug')) {
            throw $throwable;
        }

        return new HttpResponseViewModel(response_error(
            $throwable,
            'Unable to retrieve permission information',
            Response::HTTP_INTERNAL_SERVER_ERROR,
        ));
    }
    // @codeCoverageIgnoreEnd
}
