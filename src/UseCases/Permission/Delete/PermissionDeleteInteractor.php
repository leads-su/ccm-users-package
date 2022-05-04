<?php

namespace ConsulConfigManager\Users\UseCases\Permission\Delete;

use Throwable;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use ConsulConfigManager\Users\Interfaces\PermissionRepositoryInterface;

/**
 * Class PermissionDeleteInteractor
 * @package ConsulConfigManager\Users\UseCases\Permission\Delete
 */
class PermissionDeleteInteractor implements PermissionDeleteInputPort
{
    /**
     * Output port instance
     * @var PermissionDeleteOutputPort
     */
    private PermissionDeleteOutputPort $output;

    /**
     * Repository instance
     * @var PermissionRepositoryInterface
     */
    private PermissionRepositoryInterface $repository;

    /**
     * PermissionDeleteInteractor constructor.
     * @param PermissionDeleteOutputPort $output
     * @param PermissionRepositoryInterface $repository
     * @return void
     */
    public function __construct(PermissionDeleteOutputPort $output, PermissionRepositoryInterface $repository)
    {
        $this->output = $output;
        $this->repository = $repository;
    }

    /**
     * @inheritDoc
     */
    public function delete(PermissionDeleteRequestModel $requestModel): ViewModel
    {
        try {
            $entity = $this->repository->findBy('id', $requestModel->getIdentifier());
            if ($entity === null) {
                return $this->output->notFound(new PermissionDeleteResponseModel());
            }
            $entity->delete();
            return $this->output->delete(new PermissionDeleteResponseModel());
            // @codeCoverageIgnoreStart
        } catch (Throwable $throwable) {
            return $this->output->internalServerError(new PermissionDeleteResponseModel(), $throwable);
        }
        // @codeCoverageIgnoreEnd
    }
}
