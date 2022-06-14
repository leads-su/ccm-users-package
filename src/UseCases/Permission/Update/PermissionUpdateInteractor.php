<?php

namespace ConsulConfigManager\Users\UseCases\Permission\Update;

use Throwable;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use ConsulConfigManager\Users\Interfaces\PermissionRepositoryInterface;

/**
 * Class PermissionUpdateInteractor
 * @package ConsulConfigManager\Users\UseCases\Permission\Update
 */
class PermissionUpdateInteractor implements PermissionUpdateInputPort
{
    /**
     * Output port instance
     * @var PermissionUpdateOutputPort
     */
    private PermissionUpdateOutputPort $output;

    /**
     * Repository instance
     * @var PermissionRepositoryInterface
     */
    private PermissionRepositoryInterface $repository;

    /**
     * PermissionUpdateInteractor constructor.
     * @param PermissionUpdateOutputPort $output
     * @param PermissionRepositoryInterface $repository
     * @return void
     */
    public function __construct(PermissionUpdateOutputPort $output, PermissionRepositoryInterface $repository)
    {
        $this->output = $output;
        $this->repository = $repository;
    }

    /**
     * @inheritDoc
     */
    public function update(PermissionUpdateRequestModel $requestModel): ViewModel
    {
        try {
            $exists = $this->repository->findBy('id', $requestModel->getIdentifier()) !== null;
            if (!$exists) {
                return $this->output->notFound(new PermissionUpdateResponseModel());
            }
            return $this->output->update(new PermissionUpdateResponseModel(
                $this->repository->update(
                    $requestModel->getIdentifier(),
                    $requestModel->getRequest(),
                )
            ));
            // @codeCoverageIgnoreStart
        } catch (Throwable $throwable) {
            return $this->output->internalServerError(new PermissionUpdateResponseModel(), $throwable);
        }
        // @codeCoverageIgnoreEnd
    }
}
