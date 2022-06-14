<?php

namespace ConsulConfigManager\Users\UseCases\User\List;

use Throwable;
use Illuminate\Support\Arr;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use ConsulConfigManager\Users\Interfaces\UserInterface;
use ConsulConfigManager\Users\Interfaces\UserRepositoryInterface;

/**
 * Class UserListInteractor
 * @package ConsulConfigManager\Users\UseCases\User\List
 */
class UserListInteractor implements UserListInputPort
{
    /**
     * Output port instance
     * @var UserListOutputPort
     */
    private UserListOutputPort $output;

    /**
     * Repository instance
     * @var UserRepositoryInterface
     */
    private UserRepositoryInterface $repository;

    /**
     * UserListInteractor constructor.
     * @param UserListOutputPort $output
     * @param UserRepositoryInterface $repository
     * @return void
     */
    public function __construct(UserListOutputPort $output, UserRepositoryInterface $repository)
    {
        $this->output = $output;
        $this->repository = $repository;
    }

    /**
     * @inheritDoc
     */
    public function list(UserListRequestModel $requestModel): ViewModel
    {
        try {
            $users = [];
            foreach ($this->repository->all() as $user) {
                $users[] = $this->hydrateUserModel($user);
            }
            return $this->output->list(new UserListResponseModel(
                $users
            ));
            // @codeCoverageIgnoreStart
        } catch (Throwable $throwable) {
            return $this->output->internalServerError(new UserListResponseModel(), $throwable);
        }
        // @codeCoverageIgnoreEnd
    }

    private function hydrateUserModel(UserInterface $model): array
    {
        $array = $model->toArray();
        Arr::set($array, 'role', $model->getRoleAttribute());

        return $array;
    }
}
