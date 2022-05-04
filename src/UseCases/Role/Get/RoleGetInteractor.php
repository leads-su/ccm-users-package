<?php

namespace ConsulConfigManager\Users\UseCases\Role\Get;

use Throwable;
use Illuminate\Support\Arr;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use ConsulConfigManager\Users\Interfaces\RoleRepositoryInterface;

/**
 * Class RoleGetInteractor
 * @package ConsulConfigManager\Users\UseCases\Role\Get
 */
class RoleGetInteractor implements RoleGetInputPort
{
    /**
     * Output port instance
     * @var RoleGetOutputPort
     */
    private RoleGetOutputPort $output;

    /**
     * Repository instance
     * @var RoleRepositoryInterface
     */
    private RoleRepositoryInterface $repository;

    /**
     * RoleGetInteractor constructor.
     * @param RoleGetOutputPort $output
     * @param RoleRepositoryInterface $repository
     * @return void
     */
    public function __construct(RoleGetOutputPort $output, RoleRepositoryInterface $repository)
    {
        $this->output = $output;
        $this->repository = $repository;
    }

    /**
     * @inheritDoc
     */
    public function get(RoleGetRequestModel $requestModel): ViewModel
    {
        try {
            $role = $this->repository->with('permissions')->findBy('id', $requestModel->getIdentifier());
            if ($role === null) {
                return $this->output->notFound(new RoleGetResponseModel());
            }
            $roleArray = $role->toArray();
            $permissionsArray = Arr::get($roleArray, 'permissions');
            Arr::forget($roleArray, 'permissions');

            foreach ($permissionsArray as $permission) {
                $roleArray['permissions'][] = Arr::get($permission, 'id');
            }

            return $this->output->get(new RoleGetResponseModel($roleArray));
            // @codeCoverageIgnoreStart
        } catch (Throwable $throwable) {
            return $this->output->internalServerError(new RoleGetResponseModel(), $throwable);
        }
        // @codeCoverageIgnoreEnd
    }
}
