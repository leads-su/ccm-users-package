<?php

namespace ConsulConfigManager\Users\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Symfony\Component\HttpFoundation\Response;
use ConsulConfigManager\Domain\ViewModels\HttpResponseViewModel;
use ConsulConfigManager\Users\UseCases\User\Get\UserGetInputPort;
use ConsulConfigManager\Users\UseCases\User\Get\UserGetRequestModel;

/**
 * Class UserGetController
 * @package ConsulConfigManager\Users\Http\Controllers\User
 */
class UserGetController extends Controller
{
    /**
     * Input port interactor instance
     * @var UserGetInputPort
     */
    private UserGetInputPort $interactor;

    /**
     * UserGetController constructor.
     * @param UserGetInputPort $interactor
     * @return void
     */
    public function __construct(UserGetInputPort $interactor)
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
        $viewModel = $this->interactor->get(
            new UserGetRequestModel($request, $identifier)
        );

        if ($viewModel instanceof HttpResponseViewModel) {
            return $viewModel->getResponse();
        }

        return null;
    }

    // @codeCoverageIgnoreEnd
}
