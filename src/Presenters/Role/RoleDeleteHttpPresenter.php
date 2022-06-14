<?php

namespace ConsulConfigManager\Users\Presenters\Role;

use Throwable;
use Illuminate\Http\Response;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use ConsulConfigManager\Domain\ViewModels\HttpResponseViewModel;
use ConsulConfigManager\Users\UseCases\Role\Delete\RoleDeleteOutputPort;
use ConsulConfigManager\Users\UseCases\Role\Delete\RoleDeleteResponseModel;

/**
 * Class RoleDeleteHttpPresenter
 * @package ConsulConfigManager\Users\Presenters\Role
 */
class RoleDeleteHttpPresenter implements RoleDeleteOutputPort
{
    /**
     * @inheritDoc
     */
    public function delete(RoleDeleteResponseModel $responseModel): ViewModel
    {
        return new HttpResponseViewModel(response_success(
            $responseModel->getEntity(),
            'Successfully deleted role',
            Response::HTTP_OK,
        ));
    }

    /**
     * @inheritDoc
     */
    public function notFound(RoleDeleteResponseModel $responseModel): ViewModel
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
    public function internalServerError(RoleDeleteResponseModel $responseModel, Throwable $throwable): ViewModel
    {
        if (config('app.debug')) {
            throw $throwable;
        }

        return new HttpResponseViewModel(response_error(
            $throwable,
            'Unable to delete role',
            Response::HTTP_INTERNAL_SERVER_ERROR,
        ));
    }
    // @codeCoverageIgnoreEnd
}
