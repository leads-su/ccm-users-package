<?php

namespace ConsulConfigManager\Users\UseCases\User\Delete;

use Exception;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use ConsulConfigManager\Users\Interfaces\UserRepositoryInterface;

/**
 * Class UserDeleteInteractor
 *
 * @package ConsulConfigManager\Users\UseCases\User\Delete
 */
class UserDeleteInteractor implements UserDeleteInputPort
{
    /**
     * Output port instance
     *
     * @var UserDeleteOutputPort
     */
    private UserDeleteOutputPort $output;

    /**
     * Repository instance
     * @var UserRepositoryInterface
     */
    private UserRepositoryInterface $repository;

    /**
     * UserDeleteInteractor constructor.
     * @param UserDeleteOutputPort $output
     * @param UserRepositoryInterface $repository
     * @return void
     */
    public function __construct(UserDeleteOutputPort $output, UserRepositoryInterface $repository)
    {
        $this->output = $output;
        $this->repository = $repository;
    }

    /**
     * @inheritDoc
     */
    public function delete(UserDeleteRequestModel $deleteUserRequestModel): ViewModel
    {
        $user = $this->repository->find($deleteUserRequestModel->getID());

        if (!$user) {
            return $this->output->notFound($deleteUserRequestModel);
        }

        try {
            $this->repository->delete($user);
            return $this->output->delete(new UserDeleteResponseModel($user));
            // @codeCoverageIgnoreStart
        } catch (Exception $exception) {
            return $this->output->internalServerError(new UserDeleteResponseModel($user), $exception);
        }
        // @codeCoverageIgnoreEnd
    }
}
