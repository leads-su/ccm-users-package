<?php

namespace ConsulConfigManager\Users\Http\Controllers\Token;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Symfony\Component\HttpFoundation\Response;
use ConsulConfigManager\Domain\ViewModels\HttpResponseViewModel;
use ConsulConfigManager\Users\UseCases\Token\List\TokenListInputPort;
use ConsulConfigManager\Users\UseCases\Token\List\TokenListRequestModel;

/**
 * Class TokenListController
 * @package ConsulConfigManager\Users\Http\Controllers\Token
 */
class TokenListController extends Controller
{
    /**
     * Input port interactor instance
     * @var TokenListInputPort
     */
    private TokenListInputPort $interactor;

    /**
     * TokenListController constructor.
     * @param TokenListInputPort $interactor
     * @return void
     */
    public function __construct(TokenListInputPort $interactor)
    {
        $this->interactor = $interactor;
    }

    // @codeCoverageIgnoreStart

    /**
     * Handle incoming request
     * @param Request $request
     * @return Response|null
     */
    public function __invoke(Request $request): ?Response
    {
        $viewModel = $this->interactor->list(
            new TokenListRequestModel($request)
        );

        if ($viewModel instanceof HttpResponseViewModel) {
            return $viewModel->getResponse();
        }

        return null;
    }

    // @codeCoverageIgnoreEnd
}
