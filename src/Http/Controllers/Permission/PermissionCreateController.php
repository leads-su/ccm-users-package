<?php

namespace ConsulConfigManager\Users\Http\Controllers\Permission;

use Illuminate\Routing\Controller;
use Symfony\Component\HttpFoundation\Response;
use ConsulConfigManager\Domain\ViewModels\HttpResponseViewModel;
use ConsulConfigManager\Users\UseCases\Permission\Create\PermissionCreateInputPort;
use ConsulConfigManager\Users\Http\Requests\Permission\PermissionCreateUpdateRequest;
use ConsulConfigManager\Users\UseCases\Permission\Create\PermissionCreateRequestModel;

/**
 * Class PermissionCreateController
 * @package ConsulConfigManager\Users\Http\Controllers\Permission
 */
class PermissionCreateController extends Controller
{
    /**
     * Input port interactor instance
     * @var PermissionCreateInputPort
     */
    private PermissionCreateInputPort $interactor;

    /**
     * PermissionCreateController constructor.
     * @param PermissionCreateInputPort $interactor
     * @return void
     */
    public function __construct(PermissionCreateInputPort $interactor)
    {
        $this->interactor = $interactor;
    }

    // @codeCoverageIgnoreStart

    /**
     * Handle incoming request
     * @param PermissionCreateUpdateRequest $request
     * @return Response|null
     */
    public function __invoke(PermissionCreateUpdateRequest $request): ?Response
    {
        $viewModel = $this->interactor->create(
            new PermissionCreateRequestModel($request)
        );

        if ($viewModel instanceof HttpResponseViewModel) {
            return $viewModel->getResponse();
        }

        return null;
    }

    // @codeCoverageIgnoreEnd
}
