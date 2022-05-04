<?php

namespace ConsulConfigManager\Users\UseCases\User\Get;

use Throwable;
use Illuminate\Support\Arr;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use ConsulConfigManager\Users\Interfaces\UserInterface;
use ConsulConfigManager\Users\ValueObjects\UsernameValueObject;
use ConsulConfigManager\Users\Interfaces\UserRepositoryInterface;

/**
 * Class UserGetInteractor
 * @package ConsulConfigManager\Users\UseCases\User\Get
 */
class UserGetInteractor implements UserGetInputPort
{
    /**
     * Output port instance
     * @var UserGetOutputPort
     */
    private UserGetOutputPort $output;

    /**
     * Repository instance
     * @var UserRepositoryInterface
     */
    private UserRepositoryInterface $repository;

    /**
     * UserGetInteractor constructor.
     * @param UserGetOutputPort $output
     * @param UserRepositoryInterface $repository
     * @return void
     */
    public function __construct(UserGetOutputPort $output, UserRepositoryInterface $repository)
    {
        $this->output = $output;
        $this->repository = $repository;
    }

    /**
     * @inheritDoc
     */
    public function get(UserGetRequestModel $requestModel): ViewModel
    {
        $identifier = $requestModel->getIdentifier();

        try {
            $model = $this->repository->findBy('id', $identifier);
            if ($model === null) {
                $model = $this->repository->findByUsername(new UsernameValueObject($identifier));
            }
            if ($model === null) {
                return $this->output->notFound(new UserGetResponseModel());
            }

            return $this->output->get(new UserGetResponseModel(
                $this->hydrateUserModel($model)
            ));
            // @codeCoverageIgnoreStart
        } catch (Throwable $throwable) {
            return $this->output->internalServerError(new UserGetResponseModel(), $throwable);
        }
        // @codeCoverageIgnoreEnd
    }

    private function hydrateUserModel(UserInterface $model): array
    {
        $array = $model->toArray();
        Arr::set($array, 'role', $model->getRoleAttribute());

        return $array;
    }
}
