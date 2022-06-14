<?php

namespace ConsulConfigManager\Users\UseCases\Permission\Get;

use Throwable;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use ConsulConfigManager\Users\Interfaces\PermissionRepositoryInterface;

/**
 * Class PermissionGetInteractor
 * @package ConsulConfigManager\Users\UseCases\Permission\Get
 */
class PermissionGetInteractor implements PermissionGetInputPort
{
    /**
     * Output port instance
     * @var PermissionGetOutputPort
     */
    private PermissionGetOutputPort $output;

    /**
     * Repository instance
     * @var PermissionRepositoryInterface
     */
    private PermissionRepositoryInterface $repository;

    /**
     * PermissionGetInteractor constructor.
     * @param PermissionGetOutputPort $output
     * @param PermissionRepositoryInterface $repository
     * @return void
     */
    public function __construct(PermissionGetOutputPort $output, PermissionRepositoryInterface $repository)
    {
        $this->output = $output;
        $this->repository = $repository;
    }

    /**
     * @inheritDoc
     */
    public function get(PermissionGetRequestModel $requestModel): ViewModel
    {
        try {
            $permission = $this->repository->findBy('id', $requestModel->getIdentifier());
            if ($permission === null) {
                return $this->output->notFound(new PermissionGetResponseModel());
            }
            return $this->output->get(new PermissionGetResponseModel($permission));
            // @codeCoverageIgnoreStart
        } catch (Throwable $throwable) {
            return $this->output->internalServerError(new PermissionGetResponseModel(), $throwable);
        }
        // @codeCoverageIgnoreEnd
    }
}
