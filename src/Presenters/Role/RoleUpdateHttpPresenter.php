<?php

namespace ConsulConfigManager\Users\Presenters\Role;

use Throwable;
use Illuminate\Http\Response;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use ConsulConfigManager\Domain\ViewModels\HttpResponseViewModel;
use ConsulConfigManager\Users\UseCases\Role\Update\RoleUpdateOutputPort;
use ConsulConfigManager\Users\UseCases\Role\Update\RoleUpdateResponseModel;

/**
 * Class RoleUpdateHttpPresenter
 * @package ConsulConfigManager\Users\Presenters\Role
 */
class RoleUpdateHttpPresenter implements RoleUpdateOutputPort
{
    /**
     * @inheritDoc
     */
    public function update(RoleUpdateResponseModel $responseModel): ViewModel
    {
        return new HttpResponseViewModel(response_success(
            $responseModel->getEntity(),
            'Successfully updated role',
            Response::HTTP_OK,
        ));
    }

    /**
     * @inheritDoc
     */
    public function notFound(RoleUpdateResponseModel $responseModel): ViewModel
    {
        return new HttpResponseViewModel(response_error(
            [],
            'Unable to find requested role'
        ));
    }

    // @codeCoverageIgnoreStart

    /**
     * @inheritDoc
     */
    public function internalServerError(RoleUpdateResponseModel $responseModel, Throwable $throwable): ViewModel
    {
        if (config('app.debug')) {
            throw $throwable;
        }

        return new HttpResponseViewModel(response_error(
            $throwable,
            'Unable to update role',
            Response::HTTP_INTERNAL_SERVER_ERROR,
        ));
    }

    // @codeCoverageIgnoreEnd
}
