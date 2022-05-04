<?php

namespace ConsulConfigManager\Users\UseCases\Permission\List;

use Throwable;
use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface PermissionListOutputPort
 * @package ConsulConfigManager\Users\UseCases\Permission\List
 */
interface PermissionListOutputPort
{
    /**
     * Output port for "list"
     * @param PermissionListResponseModel $responseModel
     * @return ViewModel
     */
    public function list(PermissionListResponseModel $responseModel): ViewModel;

    /**
     * Output port for "internal server error"
     * @param PermissionListResponseModel $responseModel
     * @param Throwable $throwable
     * @return ViewModel
     */
    public function internalServerError(PermissionListResponseModel $responseModel, Throwable $throwable): ViewModel;
}
