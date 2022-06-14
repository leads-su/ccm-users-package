<?php

namespace ConsulConfigManager\Users\Http\Controllers\Role;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Symfony\Component\HttpFoundation\Response;
use ConsulConfigManager\Domain\ViewModels\HttpResponseViewModel;
use ConsulConfigManager\Users\UseCases\Role\Get\RoleGetInputPort;
use ConsulConfigManager\Users\UseCases\Role\Get\RoleGetRequestModel;

/**
 * Class RoleGetController
 * @package ConsulConfigManager\Users\Http\Controllers\Role
 */
class RoleGetController extends Controller
{
    /**
     * Input port interactor instance
     * @var RoleGetInputPort
     */
    private RoleGetInputPort $interactor;

    /**
     * RoleGetController constructor.
     * @param RoleGetInputPort $interactor
     * @return void
     */
    public function __construct(RoleGetInputPort $interactor)
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
            new RoleGetRequestModel($request, $identifier)
        );

        if ($viewModel instanceof HttpResponseViewModel) {
            return $viewModel->getResponse();
        }

        return null;
    }

    // @codeCoverageIgnoreEnd
}
