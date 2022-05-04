<?php

namespace ConsulConfigManager\Users\Http\Controllers\User;

use Illuminate\Routing\Controller;
use Symfony\Component\HttpFoundation\Response;
use ConsulConfigManager\Domain\ViewModels\HttpResponseViewModel;
use ConsulConfigManager\Users\Http\Requests\User\UserCreateRequest;
use ConsulConfigManager\Users\UseCases\User\Create\UserCreateInputPort;
use ConsulConfigManager\Users\UseCases\User\Create\UserCreateRequestModel;

/**
 * Class UserCreateController
 * @package ConsulConfigManager\Users\Http\Controllers\User
 */
class UserCreateController extends Controller
{
    /**
     * Create user input port interactor instance
     *
     * @var UserCreateInputPort
     */
    private UserCreateInputPort $interactor;

    /**
     * CreateUserController Constructor.
     *
     * @param UserCreateInputPort $interactor
     */
    public function __construct(UserCreateInputPort $interactor)
    {
        $this->interactor = $interactor;
    }

    // @codeCoverageIgnoreStart
    /**
     * Handle incoming request
     *
     * @param UserCreateRequest $request
     *
     * @return Response|null
     */
    public function __invoke(UserCreateRequest $request): ?Response
    {
        $viewModel = $this->interactor->create(
            new UserCreateRequestModel($request->validated())
        );

        if ($viewModel instanceof HttpResponseViewModel) {
            return $viewModel->getResponse();
        }

        return null;
    }
    // @codeCoverageIgnoreEnd
}
