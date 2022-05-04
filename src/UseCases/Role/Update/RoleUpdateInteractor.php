<?php

namespace ConsulConfigManager\Users\UseCases\Role\Update;

use Throwable;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use ConsulConfigManager\Users\Interfaces\RoleRepositoryInterface;

/**
 * Class RoleUpdateInteractor
 * @package ConsulConfigManager\Users\UseCases\Role\Update
 */
class RoleUpdateInteractor implements RoleUpdateInputPort
{
    /**
     * Output port instance
     * @var RoleUpdateOutputPort
     */
    private RoleUpdateOutputPort $output;

    /**
     * Repository instance
     * @var RoleRepositoryInterface
     */
    private RoleRepositoryInterface $repository;

    /**
     * RoleUpdateInteractor constructor.
     * @param RoleUpdateOutputPort $output
     * @param RoleRepositoryInterface $repository
     * @return void
     */
    public function __construct(RoleUpdateOutputPort $output, RoleRepositoryInterface $repository)
    {
        $this->output = $output;
        $this->repository = $repository;
    }

    /**
     * @inheritDoc
     */
    public function update(RoleUpdateRequestModel $requestModel): ViewModel
    {
        try {
            $exists = $this->repository->findBy('id', $requestModel->getIdentifier()) !== null;
            if (!$exists) {
                return $this->output->notFound(new RoleUpdateResponseModel());
            }
            return $this->output->update(new RoleUpdateResponseModel(
                $this->repository->update(
                    $requestModel->getIdentifier(),
                    $requestModel->getRequest(),
                )
            ));
            // @codeCoverageIgnoreStart
        } catch (Throwable $throwable) {
            return $this->output->internalServerError(new RoleUpdateResponseModel(), $throwable);
        }
        // @codeCoverageIgnoreEnd
    }
}
