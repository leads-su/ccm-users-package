<?php

namespace ConsulConfigManager\Users\Http\Controllers\Permission;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Symfony\Component\HttpFoundation\Response;
use ConsulConfigManager\Domain\ViewModels\HttpResponseViewModel;
use ConsulConfigManager\Users\UseCases\Permission\Get\PermissionGetInputPort;
use ConsulConfigManager\Users\UseCases\Permission\Get\PermissionGetRequestModel;

/**
 * Class PermissionGetController
 * @package ConsulConfigManager\Users\Http\Controllers\Permission
 */
class PermissionGetController extends Controller
{
    /**
     * Input port interactor instance
     * @var PermissionGetInputPort
     */
    private PermissionGetInputPort $interactor;

    /**
     * PermissionGetController constructor.
     * @param PermissionGetInputPort $interactor
     * @return void
     */
    public function __construct(PermissionGetInputPort $interactor)
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
            new PermissionGetRequestModel($request, $identifier)
        );

        if ($viewModel instanceof HttpResponseViewModel) {
            return $viewModel->getResponse();
        }

        return null;
    }

    // @codeCoverageIgnoreEnd
}
