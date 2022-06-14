<?php

namespace ConsulConfigManager\Users\UseCases\User\Create;

use Exception;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use ConsulConfigManager\Users\Interfaces\UserFactoryInterface;
use ConsulConfigManager\Users\ValueObjects\PasswordValueObject;
use ConsulConfigManager\Users\Interfaces\UserRepositoryInterface;

/**
 * Class UserCreateInteractor
 *
 * @package ConsulConfigManager\Users\UseCases\User\Create
 */
class UserCreateInteractor implements UserCreateInputPort
{
    /**
     * Output port instance
     *
     * @var UserCreateOutputPort
     */
    private UserCreateOutputPort $output;

    /**
     * Repository instance
     * @var UserRepositoryInterface
     */
    private UserRepositoryInterface $repository;

    /**
     * Factory instance
     * @var UserFactoryInterface
     */
    private UserFactoryInterface $factory;

    /**
     * UserCreateInteractor constructor.
     * @param UserCreateOutputPort $output
     * @param UserRepositoryInterface $repository
     * @param UserFactoryInterface $factory
     * @return void
     */
    public function __construct(UserCreateOutputPort $output, UserRepositoryInterface $repository, UserFactoryInterface $factory)
    {
        $this->output = $output;
        $this->repository = $repository;
        $this->factory = $factory;
    }

    /**
     * @inheritDoc
     */
    public function create(UserCreateRequestModel $createUserRequestModel): ViewModel
    {
        $user = $this->factory->make([
            'first_name'        =>  $createUserRequestModel->getFirstName(),
            'last_name'         =>  $createUserRequestModel->getLastName(),
            'username'          =>  $createUserRequestModel->getUsername(),
            'email'             =>  $createUserRequestModel->getEmail(),
            'password'          =>  $createUserRequestModel->getPassword(),
        ]);

        if ($this->repository->exists($user)) {
            return $this->output->alreadyExists(new UserCreateResponseModel($user));
        }

        try {
            $user = $this->repository->create($user, new PasswordValueObject($createUserRequestModel->getPassword()));
            $user->assignRole(config('domain.users.default_role'));
            return $this->output->create(new UserCreateResponseModel($user));

            // @codeCoverageIgnoreStart
        } catch (Exception $exception) {
            return $this->output->internalServerError(new UserCreateResponseModel($user), $exception);
        }
        // @codeCoverageIgnoreEnd
    }
}
