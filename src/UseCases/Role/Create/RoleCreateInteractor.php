<?php

namespace ConsulConfigManager\Users\UseCases\Role\Create;

use Throwable;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use ConsulConfigManager\Users\Interfaces\RoleRepositoryInterface;

/**
 * Class RoleCreateInteractor
 * @package ConsulConfigManager\Users\UseCases\Role\Create
 */
class RoleCreateInteractor implements RoleCreateInputPort
{
    /**
     * Output port instance
     * @var RoleCreateOutputPort
     */
    private RoleCreateOutputPort $output;

    /**
     * Repository instance
     * @var RoleRepositoryInterface
     */
    private RoleRepositoryInterface $repository;

    /**
     * RoleCreateInteractor constructor.
     * @param RoleCreateOutputPort $output
     * @param RoleRepositoryInterface $repository
     * @return void
     */
    public function __construct(RoleCreateOutputPort $output, RoleRepositoryInterface $repository)
    {
        $this->output = $output;
        $this->repository = $repository;
    }

    /**
     * @inheritDoc
     */
    public function create(RoleCreateRequestModel $requestModel): ViewModel
    {
        $request = $requestModel->getRequest();
        try {
            $exists = $this->repository->findBy('name', $request->get('name')) !== null;
            if ($exists) {
                return $this->output->alreadyExists(new RoleCreateResponseModel());
            }

            return $this->output->create(new RoleCreateResponseModel(
                $this->repository->create($request)
            ));
            // @codeCoverageIgnoreStart
        } catch (Throwable $throwable) {
            return $this->output->internalServerError(new RoleCreateResponseModel(), $throwable);
        }
        // @codeCoverageIgnoreEnd
    }
}
