<?php

namespace ConsulConfigManager\Users\UseCases\User\Update;

use Exception;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use ConsulConfigManager\Users\Interfaces\UserFactoryInterface;
use ConsulConfigManager\Users\Interfaces\UserRepositoryInterface;

/**
 * Class UserUpdateInteractor
 *
 * @package ConsulConfigManager\Users\UseCases\User\Update
 */
class UserUpdateInteractor implements UserUpdateInputPort
{
    /**
     * Output port instance
     *
     * @var UserUpdateOutputPort
     */
    private UserUpdateOutputPort $output;

    /**
     * Repository instance
     * @var UserRepositoryInterface
     */
    private UserRepositoryInterface $repository;

    /**
     * Factory instance
     * @var UserFactoryInterface
     */
    private UserFactoryInterface $factory;

    /**
     * UserUpdateInteractor constructor.
     * @param UserUpdateOutputPort $output
     * @param UserRepositoryInterface $repository
     * @param UserFactoryInterface $factory
     * @return void
     */
    public function __construct(UserUpdateOutputPort $output, UserRepositoryInterface $repository, UserFactoryInterface $factory)
    {
        $this->output = $output;
        $this->repository = $repository;
        $this->factory = $factory;
    }

    /**
     * @inheritDoc
     */
    public function update(UserUpdateRequestModel $updateUserRequestModel): ViewModel
    {
        $userEntity = $this->repository->find($updateUserRequestModel->getID());

        if (!$userEntity) {
            return $this->output->notFound($updateUserRequestModel);
        }

        $user = $this->factory->make([
            'first_name'        =>  $updateUserRequestModel->getFirstName(),
            'last_name'         =>  $updateUserRequestModel->getLastName(),
            'username'          =>  $updateUserRequestModel->getUsername(),
            'email'             =>  $updateUserRequestModel->getEmail(),
        ]);

        try {
            $userEntity = $this->repository->update($updateUserRequestModel->getID(), $user);
            if ($updateUserRequestModel->getRole() !== $userEntity->getRoleAttribute()) {
                foreach ($userEntity->getRoleNames() as $roleName) {
                    $userEntity->removeRole($roleName);
                }
                $userEntity->assignRole($updateUserRequestModel->getRole());
            }

            return $this->output->update(new UserUpdateResponseModel($userEntity));
            // @codeCoverageIgnoreStart
        } catch (Exception $exception) {
            return $this->output->internalServerError(new UserUpdateResponseModel($userEntity), $exception);
        }
        // @codeCoverageIgnoreEnd
    }
}
