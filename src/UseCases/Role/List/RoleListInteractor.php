<?php

namespace ConsulConfigManager\Users\UseCases\Role\List;

use Throwable;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use ConsulConfigManager\Users\Interfaces\RoleRepositoryInterface;

/**
 * Class RoleListInteractor
 * @package ConsulConfigManager\Users\UseCases\Role\List
 */
class RoleListInteractor implements RoleListInputPort
{
    /**
     * Output port instance
     * @var RoleListOutputPort
     */
    private RoleListOutputPort $output;

    /**
     * Repository instance
     * @var RoleRepositoryInterface
     */
    private RoleRepositoryInterface $repository;

    /**
     * RoleListInteractor constructor.
     * @param RoleListOutputPort $output
     * @param RoleRepositoryInterface $repository
     */
    public function __construct(RoleListOutputPort $output, RoleRepositoryInterface $repository)
    {
        $this->output = $output;
        $this->repository = $repository;
    }

    /**
     * @inheritDoc
     */
    public function list(RoleListRequestModel $requestModel): ViewModel
    {
        try {
            return $this->output->list(new RoleListResponseModel(
                $this->repository->all()
            ));
            // @codeCoverageIgnoreStart
        } catch (Throwable $throwable) {
            return $this->output->internalServerError(new RoleListResponseModel(), $throwable);
        }
        // @codeCoverageIgnoreEnd
    }
}
