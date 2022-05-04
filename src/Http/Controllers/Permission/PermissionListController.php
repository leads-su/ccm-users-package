<?php

namespace ConsulConfigManager\Users\Http\Controllers\Permission;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Symfony\Component\HttpFoundation\Response;
use ConsulConfigManager\Domain\ViewModels\HttpResponseViewModel;
use ConsulConfigManager\Users\UseCases\Permission\List\PermissionListInputPort;
use ConsulConfigManager\Users\UseCases\Permission\List\PermissionListRequestModel;

/**
 * Class PermissionListController
 * @package ConsulConfigManager\Users\Http\Controllers\Permission
 */
class PermissionListController extends Controller
{
    /**
     * Input port interactor instance
     * @var PermissionListInputPort
     */
    private PermissionListInputPort $interactor;

    /**
     * PermissionListController constructor.
     * @param PermissionListInputPort $interactor
     * @return void
     */
    public function __construct(PermissionListInputPort $interactor)
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
            new PermissionListRequestModel($request)
        );

        if ($viewModel instanceof HttpResponseViewModel) {
            return $viewModel->getResponse();
        }

        return null;
    }

    // @codeCoverageIgnoreEnd
}
