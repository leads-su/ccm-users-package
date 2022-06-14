<?php

namespace ConsulConfigManager\Users\Http\Controllers\User;

use Illuminate\Routing\Controller;
use Symfony\Component\HttpFoundation\Response;
use ConsulConfigManager\Domain\ViewModels\HttpResponseViewModel;
use ConsulConfigManager\Users\Http\Requests\User\UserDeleteRequest;
use ConsulConfigManager\Users\UseCases\User\Delete\UserDeleteInputPort;
use ConsulConfigManager\Users\UseCases\User\Delete\UserDeleteRequestModel;

/**
 * Class UserDeleteController
 * @package ConsulConfigManager\Users\Http\Controllers\User
 */
class UserDeleteController extends Controller
{
    /**
     * Delete user input port interactor instance
     *
     * @var UserDeleteInputPort
     */
    private UserDeleteInputPort $interactor;

    /**
     * DeleteUserController Constructor.
     *
     * @param UserDeleteInputPort $interactor
     */
    public function __construct(UserDeleteInputPort $interactor)
    {
        $this->interactor = $interactor;
    }

    // @codeCoverageIgnoreStart
    /**
     * Handle incoming request
     *
     * @param UserDeleteRequest $request
     *
     * @return Response|null
     */
    public function __invoke(UserDeleteRequest $request): ?Response
    {
        $viewModel = $this->interactor->delete(
            new UserDeleteRequestModel($request->validated())
        );

        if ($viewModel instanceof HttpResponseViewModel) {
            return $viewModel->getResponse();
        }

        return null;
    }
    // @codeCoverageIgnoreEnd
}
