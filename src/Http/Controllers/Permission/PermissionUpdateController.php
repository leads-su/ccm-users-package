<?php

namespace ConsulConfigManager\Users\Http\Controllers\Permission;

use Illuminate\Routing\Controller;
use Symfony\Component\HttpFoundation\Response;
use ConsulConfigManager\Domain\ViewModels\HttpResponseViewModel;
use ConsulConfigManager\Users\UseCases\Permission\Update\PermissionUpdateInputPort;
use ConsulConfigManager\Users\Http\Requests\Permission\PermissionCreateUpdateRequest;
use ConsulConfigManager\Users\UseCases\Permission\Update\PermissionUpdateRequestModel;

/**
 * Class PermissionUpdateController
 * @package ConsulConfigManager\Users\Http\Controllers\Permission
 */
class PermissionUpdateController extends Controller
{
    /**
     * Input port interactor instance
     * @var PermissionUpdateInputPort
     */
    private PermissionUpdateInputPort $interactor;

    /**
     * PermissionUpdateController constructor.
     * @param PermissionUpdateInputPort $interactor
     * @return void
     */
    public function __construct(PermissionUpdateInputPort $interactor)
    {
        $this->interactor = $interactor;
    }

    // @codeCoverageIgnoreStart

    /**
     * Handle incoming request
     * @param PermissionCreateUpdateRequest $request
     * @param string|int $identifier
     * @return Response|null
     */
    public function __invoke(PermissionCreateUpdateRequest $request, string|int $identifier): ?Response
    {
        $viewModel = $this->interactor->update(
            new PermissionUpdateRequestModel($request, $identifier)
        );

        if ($viewModel instanceof HttpResponseViewModel) {
            return $viewModel->getResponse();
        }

        return null;
    }

    // @codeCoverageIgnoreEnd
}
