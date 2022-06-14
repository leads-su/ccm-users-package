<?php

namespace ConsulConfigManager\Users\Presenters\Token;

use Throwable;
use Illuminate\Http\Response;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use ConsulConfigManager\Domain\ViewModels\HttpResponseViewModel;
use ConsulConfigManager\Users\UseCases\Token\List\TokenListOutputPort;
use ConsulConfigManager\Users\UseCases\Token\List\TokenListResponseModel;

/**
 * Class TokenListHttpPresenter
 * @package ConsulConfigManager\Users\Presenters\Token
 */
class TokenListHttpPresenter implements TokenListOutputPort
{
    /**
     * @inheritDoc
     */
    public function list(TokenListResponseModel $responseModel): ViewModel
    {
        return new HttpResponseViewModel(response_success(
            $responseModel->getEntities(),
            'Successfully fetched list of tokens',
            Response::HTTP_OK,
        ));
    }

    // @codeCoverageIgnoreStart
    /**
     * @inheritDoc
     */
    public function internalServerError(TokenListResponseModel $responseModel, Throwable $throwable): ViewModel
    {
        if (config('app.debug')) {
            throw $throwable;
        }

        return new HttpResponseViewModel(response_error(
            $throwable,
            'Failed to retrieve list of tokens',
            Response::HTTP_INTERNAL_SERVER_ERROR,
        ));
    }
    // @codeCoverageIgnoreEnd
}
