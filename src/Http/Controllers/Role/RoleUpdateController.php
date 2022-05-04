<?php

namespace ConsulConfigManager\Users\Http\Controllers\Role;

use Illuminate\Routing\Controller;
use Symfony\Component\HttpFoundation\Response;
use ConsulConfigManager\Domain\ViewModels\HttpResponseViewModel;
use ConsulConfigManager\Users\UseCases\Role\Update\RoleUpdateInputPort;
use ConsulConfigManager\Users\Http\Requests\Role\RoleCreateUpdateRequest;
use ConsulConfigManager\Users\UseCases\Role\Update\RoleUpdateRequestModel;

/**
 * Class RoleUpdateController
 * @package ConsulConfigManager\Users\Http\Controllers\Role
 */
class RoleUpdateController extends Controller
{
    /**
     * Input port interactor instance
     * @var RoleUpdateInputPort
     */
    private RoleUpdateInputPort $interactor;

    /**
     * RoleUpdateController constructor.
     * @param RoleUpdateInputPort $interactor
     * @return void
     */
    public function __construct(RoleUpdateInputPort $interactor)
    {
        $this->interactor = $interactor;
    }

    // @codeCoverageIgnoreStart

    /**
     * Handle incoming request
     * @param RoleCreateUpdateRequest $request
     * @param string|int $identifier
     * @return Response|null
     */
    public function __invoke(RoleCreateUpdateRequest $request, string|int $identifier): ?Response
    {
        $viewModel = $this->interactor->update(
            new RoleUpdateRequestModel($request, $identifier)
        );

        if ($viewModel instanceof HttpResponseViewModel) {
            return $viewModel->getResponse();
        }

        return null;
    }

    // @codeCoverageIgnoreEnd
}
