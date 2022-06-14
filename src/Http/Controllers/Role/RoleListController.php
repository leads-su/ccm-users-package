<?php

namespace ConsulConfigManager\Users\Http\Controllers\Role;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Symfony\Component\HttpFoundation\Response;
use ConsulConfigManager\Domain\ViewModels\HttpResponseViewModel;
use ConsulConfigManager\Users\UseCases\Role\List\RoleListInputPort;
use ConsulConfigManager\Users\UseCases\Role\List\RoleListRequestModel;

/**
 * Class RoleListController
 * @package ConsulConfigManager\Users\Http\Controllers\Role
 */
class RoleListController extends Controller
{
    /**
     * Input port interactor instance
     * @var RoleListInputPort
     */
    private RoleListInputPort $interactor;

    /**
     * RoleListController constructor.
     * @param RoleListInputPort $interactor
     * @return void
     */
    public function __construct(RoleListInputPort $interactor)
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
            new RoleListRequestModel($request)
        );

        if ($viewModel instanceof HttpResponseViewModel) {
            return $viewModel->getResponse();
        }

        return null;
    }

    // @codeCoverageIgnoreEnd
}
