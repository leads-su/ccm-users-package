<?php

namespace ConsulConfigManager\Users\UseCases\User\Create;

use Throwable;
use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface UserCreateOutputPort
 *
 * @package ConsulConfigManager\Users\UseCases\User\Create
 */
interface UserCreateOutputPort
{
    /**
     * Output port for "create"
     * @param UserCreateResponseModel $createUserResponseModel
     * @return ViewModel
     */
    public function create(UserCreateResponseModel $createUserResponseModel): ViewModel;

    /**
     * Output port for "already exists"
     * @param UserCreateResponseModel $createUserResponseModel
     * @return ViewModel
     */
    public function alreadyExists(UserCreateResponseModel $createUserResponseModel): ViewModel;

    /**
     * Output port for "internal server error"
     * @param UserCreateResponseModel $responseModel
     * @param Throwable $exception
     * @return ViewModel
     */
    public function internalServerError(UserCreateResponseModel $responseModel, Throwable $exception): ViewModel;
}
