<?php

namespace ConsulConfigManager\Users\UseCases\User\Update;

use Throwable;
use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface UserUpdateOutputPort
 *
 * @package ConsulConfigManager\Users\UseCases\User\Update
 */
interface UserUpdateOutputPort
{
    /**
     * Output port for "update"
     * @param UserUpdateResponseModel $updateUserResponseModel
     * @return ViewModel
     */
    public function update(UserUpdateResponseModel $updateUserResponseModel): ViewModel;

    /**
     * Output port for "not found"
     * @param UserUpdateRequestModel $updateUserRequestModel
     * @return ViewModel
     */
    public function notFound(UserUpdateRequestModel $updateUserRequestModel): ViewModel;

    /**
     * Output port for "internal server error"
     * @param UserUpdateResponseModel $updateUserResponseModel
     * @param Throwable $exception
     * @return ViewModel
     */
    public function internalServerError(UserUpdateResponseModel $updateUserResponseModel, Throwable $exception): ViewModel;
}
