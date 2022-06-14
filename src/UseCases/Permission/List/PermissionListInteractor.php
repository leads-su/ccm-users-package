<?php

namespace ConsulConfigManager\Users\UseCases\Permission\List;

use Throwable;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use ConsulConfigManager\Users\Interfaces\PermissionRepositoryInterface;

/**
 * Class PermissionListInteractor
 * @package ConsulConfigManager\Users\UseCases\Permission\List
 */
class PermissionListInteractor implements PermissionListInputPort
{
    /**
     * Output port instance
     * @var PermissionListOutputPort
     */
    private PermissionListOutputPort $output;

    /**
     * Repository instance
     * @var PermissionRepositoryInterface
     */
    private PermissionRepositoryInterface $repository;

    /**
     * PermissionListInteractor constructor.
     * @param PermissionListOutputPort $output
     * @param PermissionRepositoryInterface $repository
     */
    public function __construct(PermissionListOutputPort $output, PermissionRepositoryInterface $repository)
    {
        $this->output = $output;
        $this->repository = $repository;
    }

    /**
     * @inheritDoc
     */
    public function list(PermissionListRequestModel $requestModel): ViewModel
    {
        try {
            return $this->output->list(new PermissionListResponseModel(
                $this->repository->all()
            ));
            // @codeCoverageIgnoreStart
        } catch (Throwable $throwable) {
            return $this->output->internalServerError(new PermissionListResponseModel(), $throwable);
        }
        // @codeCoverageIgnoreEnd
    }
}
