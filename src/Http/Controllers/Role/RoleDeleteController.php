<?php

namespace ConsulConfigManager\Users\Http\Controllers\Role;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Symfony\Component\HttpFoundation\Response;
use ConsulConfigManager\Domain\ViewModels\HttpResponseViewModel;
use ConsulConfigManager\Users\UseCases\Role\Delete\RoleDeleteInputPort;
use ConsulConfigManager\Users\UseCases\Role\Delete\RoleDeleteRequestModel;

/**
 * Class RoleDeleteController
 * @package ConsulConfigManager\Users\Http\Controllers\Role
 */
class RoleDeleteController extends Controller
{
    /**
     * Input port interactor instance
     * @var RoleDeleteInputPort
     */
    private RoleDeleteInputPort $interactor;

    /**
     * RoleDeleteController constructor.
     * @param RoleDeleteInputPort $interactor
     * @return void
     */
    public function __construct(RoleDeleteInputPort $interactor)
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
            new RoleDeleteRequestModel($request, $identifier)
        );

        if ($viewModel instanceof HttpResponseViewModel) {
            return $viewModel->getResponse();
        }

        return null;
    }

    // @codeCoverageIgnoreEnd
}
