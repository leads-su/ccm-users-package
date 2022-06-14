<?php

namespace ConsulConfigManager\Users\Presenters\Token;

use Throwable;
use Illuminate\Http\Response;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use ConsulConfigManager\Domain\ViewModels\HttpResponseViewModel;
use ConsulConfigManager\Users\UseCases\Token\Delete\TokenDeleteOutputPort;
use ConsulConfigManager\Users\UseCases\Token\Delete\TokenDeleteResponseModel;

/**
 * Class TokenDeleteHttpPresenter
 * @package ConsulConfigManager\Users\Presenters\Token
 */
class TokenDeleteHttpPresenter implements TokenDeleteOutputPort
{
    /**
     * @inheritDoc
     */
    public function delete(TokenDeleteResponseModel $responseModel): ViewModel
    {
        return new HttpResponseViewModel(response_success(
            $responseModel->getEntity(),
            'Successfully deleted requested token',
            Response::HTTP_OK,
        ));
    }

    /**
     * @inheritDoc
     */
    public function notFound(TokenDeleteResponseModel $responseModel): ViewModel
    {
        return new HttpResponseViewModel(response_error(
            $responseModel->getEntity(),
            'Unable to find requested token',
            Response::HTTP_NOT_FOUND
        ));
    }

    // @codeCoverageIgnoreStart
    /**
     * @inheritDoc
     */
    public function internalServerError(TokenDeleteResponseModel $responseModel, Throwable $throwable): ViewModel
    {
        if (config('app.debug')) {
            throw $throwable;
        }

        return new HttpResponseViewModel(response_error(
            $throwable,
            'Failed to delete specified token',
            Response::HTTP_INTERNAL_SERVER_ERROR,
        ));
    }
    // @codeCoverageIgnoreEnd
}
