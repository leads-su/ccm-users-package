<?php

namespace ConsulConfigManager\Users\Presenters\Role;

use Throwable;
use Illuminate\Http\Response;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use ConsulConfigManager\Domain\ViewModels\HttpResponseViewModel;
use ConsulConfigManager\Users\UseCases\Role\List\RoleListOutputPort;
use ConsulConfigManager\Users\UseCases\Role\List\RoleListResponseModel;

/**
 * Class RoleListHttpPresenter
 * @package ConsulConfigManager\Users\Presenters\Role
 */
class RoleListHttpPresenter implements RoleListOutputPort
{
    /**
     * @inheritDoc
     */
    public function list(RoleListResponseModel $responseModel): ViewModel
    {
        return new HttpResponseViewModel(response_success(
            $responseModel->getEntities(),
            'Successfully fetched list of roles',
            Response::HTTP_OK,
        ));
    }

    // @codeCoverageIgnoreStart
    /**
     * @inheritDoc
     */
    public function internalServerError(RoleListResponseModel $responseModel, Throwable $throwable): ViewModel
    {
        if (config('app.debug')) {
            throw $throwable;
        }

        return new HttpResponseViewModel(response_error(
            $throwable,
            'Unable to retrieve roles list',
            Response::HTTP_INTERNAL_SERVER_ERROR,
        ));
    }
    // @codeCoverageIgnoreEnd
}
