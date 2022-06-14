<?php

namespace ConsulConfigManager\Users\Http\Controllers\Token;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Symfony\Component\HttpFoundation\Response;
use ConsulConfigManager\Domain\ViewModels\HttpResponseViewModel;
use ConsulConfigManager\Users\UseCases\Token\Delete\TokenDeleteInputPort;
use ConsulConfigManager\Users\UseCases\Token\Delete\TokenDeleteRequestModel;

/**
 * Class TokenDeleteController
 * @package ConsulConfigManager\Users\Http\Controllers\Token
 */
class TokenDeleteController extends Controller
{
    /**
     * Input port interactor instance
     * @var TokenDeleteInputPort
     */
    private TokenDeleteInputPort $interactor;

    /**
     * TokenDeleteController constructor.
     * @param TokenDeleteInputPort $interactor
     * @return void
     */
    public function __construct(TokenDeleteInputPort $interactor)
    {
        $this->interactor = $interactor;
    }

    // @codeCoverageIgnoreStart

    /**
     * Handle incoming request
     * @param Request $request
     * @param string|int $identifier
     * @return Response|null
     */
    public function __invoke(Request $request, string|int $identifier): ?Response
    {
        $viewModel = $this->interactor->delete(
            new TokenDeleteRequestModel($request, $identifier)
        );

        if ($viewModel instanceof HttpResponseViewModel) {
            return $viewModel->getResponse();
        }

        return null;
    }

    // @codeCoverageIgnoreEnd
}
