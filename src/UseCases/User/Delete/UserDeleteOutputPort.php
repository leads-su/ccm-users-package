<?php

namespace ConsulConfigManager\Users\UseCases\User\Delete;

use Throwable;
use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface UserDeleteOutputPort
 *
 * @package ConsulConfigManager\Users\UseCases\User\Delete
 */
interface UserDeleteOutputPort
{
    /**
     * Output port for "delete"
     * @param UserDeleteResponseModel $deleteUserResponseModel
     * @return ViewModel
     */
    public function delete(UserDeleteResponseModel $deleteUserResponseModel): ViewModel;

    /**
     * Output port for "not found"
     * @param UserDeleteRequestModel $deleteRequestModel
     * @return ViewModel
     */
    public function notFound(UserDeleteRequestModel $deleteRequestModel): ViewModel;

    /**
     * Output port for "internal server error"
     * @param UserDeleteResponseModel $deleteUserResponseModel
     * @param Throwable $exception
     * @return ViewModel
     */
    public function internalServerError(UserDeleteResponseModel $deleteUserResponseModel, Throwable $exception): ViewModel;
}
