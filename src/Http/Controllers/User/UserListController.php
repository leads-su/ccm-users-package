<?php

namespace ConsulConfigManager\Users\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Symfony\Component\HttpFoundation\Response;
use ConsulConfigManager\Domain\ViewModels\HttpResponseViewModel;
use ConsulConfigManager\Users\UseCases\User\List\UserListInputPort;
use ConsulConfigManager\Users\UseCases\User\List\UserListRequestModel;

/**
 * Class UserListController
 * @package ConsulConfigManager\Users\Http\Controllers\User
 */
class UserListController extends Controller
{
    /**
     * Input port interactor instance
     * @var UserListInputPort
     */
    private UserListInputPort $interactor;

    /**
     * UserListController constructor.
     * @param UserListInputPort $interactor
     * @return void
     */
    public function __construct(UserListInputPort $interactor)
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
            new UserListRequestModel($request)
        );

        if ($viewModel instanceof HttpResponseViewModel) {
            return $viewModel->getResponse();
        }

        return null;
    }

    // @codeCoverageIgnoreEnd
}
