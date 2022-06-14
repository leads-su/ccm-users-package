<?php

namespace ConsulConfigManager\Users\Http\Controllers\Permission;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Symfony\Component\HttpFoundation\Response;
use ConsulConfigManager\Domain\ViewModels\HttpResponseViewModel;
use ConsulConfigManager\Users\UseCases\Permission\Delete\PermissionDeleteInputPort;
use ConsulConfigManager\Users\UseCases\Permission\Delete\PermissionDeleteRequestModel;

/**
 * Class PermissionDeleteController
 * @package ConsulConfigManager\Users\Http\Controllers\Permission
 */
class PermissionDeleteController extends Controller
{
    /**
     * Input port interactor instance
     * @var PermissionDeleteInputPort
     */
    private PermissionDeleteInputPort $interactor;

    /**
     * PermissionDeleteController constructor.
     * @param PermissionDeleteInputPort $interactor
     * @return void
     */
    public function __construct(PermissionDeleteInputPort $interactor)
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
            new PermissionDeleteRequestModel($request, $identifier)
        );

        if ($viewModel instanceof HttpResponseViewModel) {
            return $viewModel->getResponse();
        }

        return null;
    }

    // @codeCoverageIgnoreEnd
}
