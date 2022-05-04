<?php

namespace ConsulConfigManager\Users\UseCases\Permission\Create;

use Throwable;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use ConsulConfigManager\Users\Interfaces\PermissionRepositoryInterface;

/**
 * Class PermissionCreateInteractor
 * @package ConsulConfigManager\Users\UseCases\Permission\Create
 */
class PermissionCreateInteractor implements PermissionCreateInputPort
{
    /**
     * Output port instance
     * @var PermissionCreateOutputPort
     */
    private PermissionCreateOutputPort $output;

    /**
     * Repository instance
     * @var PermissionRepositoryInterface
     */
    private PermissionRepositoryInterface $repository;

    /**
     * PermissionCreateInteractor constructor.
     * @param PermissionCreateOutputPort $output
     * @param PermissionRepositoryInterface $repository
     * @return void
     */
    public function __construct(PermissionCreateOutputPort $output, PermissionRepositoryInterface $repository)
    {
        $this->output = $output;
        $this->repository = $repository;
    }

    /**
     * @inheritDoc
     */
    public function create(PermissionCreateRequestModel $requestModel): ViewModel
    {
        $request = $requestModel->getRequest();
        try {
            $exists = $this->repository->findBy('name', $request->get('name')) !== null;
            if ($exists) {
                return $this->output->alreadyExists(new PermissionCreateResponseModel());
            }


            return $this->output->create(new PermissionCreateResponseModel(
                $this->repository->create($request)
            ));
            // @codeCoverageIgnoreStart
        } catch (Throwable $throwable) {
            return $this->output->internalServerError(new PermissionCreateResponseModel(), $throwable);
        }
        // @codeCoverageIgnoreEnd
    }
}
