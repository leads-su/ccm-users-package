<?php

namespace ConsulConfigManager\Users\Http\Controllers\User;

use Illuminate\Routing\Controller;
use Symfony\Component\HttpFoundation\Response;
use ConsulConfigManager\Domain\ViewModels\HttpResponseViewModel;
use ConsulConfigManager\Users\Http\Requests\User\UserUpdateRequest;
use ConsulConfigManager\Users\UseCases\User\Update\UserUpdateInputPort;
use ConsulConfigManager\Users\UseCases\User\Update\UserUpdateRequestModel;

/**
 * Class UserUpdateController
 * @package ConsulConfigManager\Users\Http\Controllers\User
 */
class UserUpdateController extends Controller
{
    /**
     * Update user input port interactor instance
     *
     * @var UserUpdateInputPort
     */
    private UserUpdateInputPort $interactor;

    /**
     * UpdateUserController Constructor.
     *
     * @param UserUpdateInputPort $interactor
     */
    public function __construct(UserUpdateInputPort $interactor)
    {
        $this->interactor = $interactor;
    }

    // @codeCoverageIgnoreStart
    /**
     * Handle incoming request
     *
     * @param UserUpdateRequest $request
     *
     * @return Response|null
     */
    public function __invoke(UserUpdateRequest $request): ?Response
    {
        $viewModel = $this->interactor->update(
            new UserUpdateRequestModel($request->validated())
        );

        if ($viewModel instanceof HttpResponseViewModel) {
            return $viewModel->getResponse();
        }

        return null;
    }
    // @codeCoverageIgnoreEnd
}
