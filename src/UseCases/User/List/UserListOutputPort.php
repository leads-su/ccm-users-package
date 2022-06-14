<?php

namespace ConsulConfigManager\Users\UseCases\User\List;

use Throwable;
use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface UserListOutputPort
 * @package ConsulConfigManager\Users\UseCases\User\List
 */
interface UserListOutputPort
{
    /**
     * Output port for "list"
     * @param UserListResponseModel $responseModel
     * @return ViewModel
     */
    public function list(UserListResponseModel $responseModel): ViewModel;

    /**
     * Output port for "internal server error"
     * @param UserListResponseModel $responseModel
     * @param Throwable $throwable
     * @return ViewModel
     */
    public function internalServerError(UserListResponseModel $responseModel, Throwable $throwable): ViewModel;
}
