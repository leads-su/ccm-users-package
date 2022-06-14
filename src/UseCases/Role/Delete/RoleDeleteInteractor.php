<?php

namespace ConsulConfigManager\Users\UseCases\Role\Delete;

use Throwable;
use Spatie\Permission\Contracts\Role;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use ConsulConfigManager\Users\Interfaces\UserInterface;
use ConsulConfigManager\Users\Interfaces\RoleRepositoryInterface;
use ConsulConfigManager\Users\Interfaces\UserRepositoryInterface;

/**
 * Class RoleDeleteInteractor
 * @package ConsulConfigManager\Users\UseCases\Role\Delete
 */
class RoleDeleteInteractor implements RoleDeleteInputPort
{
    /**
     * Output port instance
     * @var RoleDeleteOutputPort
     */
    private RoleDeleteOutputPort $output;

    /**
     * Repository instance
     * @var RoleRepositoryInterface
     */
    private RoleRepositoryInterface $repository;

    /**
     * User repository instance
     * @var UserRepositoryInterface
     */
    private UserRepositoryInterface $userRepository;

    /**
     * RoleDeleteInteractor constructor.
     * @param RoleDeleteOutputPort $output
     * @param RoleRepositoryInterface $repository
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(RoleDeleteOutputPort $output, RoleRepositoryInterface $repository, UserRepositoryInterface $userRepository)
    {
        $this->output = $output;
        $this->repository = $repository;
        $this->userRepository = $userRepository;
    }

    /**
     * @inheritDoc
     */
    public function delete(RoleDeleteRequestModel $requestModel): ViewModel
    {
        try {
            $entity = $this->repository->findBy('id', $requestModel->getIdentifier());
            if ($entity === null) {
                return $this->output->notFound(new RoleDeleteResponseModel());
            }
            return $this->output->delete($this->handleRoleDeletionTasks(
                currentRoleInstance: $entity,
            ));
            // @codeCoverageIgnoreStart
        } catch (Throwable $throwable) {
            return $this->output->internalServerError(new RoleDeleteResponseModel(), $throwable);
        }
        // @codeCoverageIgnoreEnd
    }

    /**
     * Handle necessary tasks for role deletion
     * @param Role $currentRoleInstance
     * @return RoleDeleteResponseModel
     */
    private function handleRoleDeletionTasks(Role $currentRoleInstance): RoleDeleteResponseModel
    {
        $guestRoleInstance = $this->repository->findBy('name', 'guest');
        $usersWithCurrentRole = $this->userRepository->withRole($currentRoleInstance->name);

        /**
         * @var UserInterface $user
         */
        foreach ($usersWithCurrentRole as $user) {
            $user
                ->removeRole($currentRoleInstance)
                ->assignRole($guestRoleInstance);
        }

        foreach ($currentRoleInstance->permissions as $permission) {
            $currentRoleInstance->revokePermissionTo($permission);
        }

        $currentRoleInstance->delete();
        return new RoleDeleteResponseModel();
    }
}
