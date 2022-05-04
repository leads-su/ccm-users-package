<?php

namespace ConsulConfigManager\Users\UseCases\Permission\Delete;

use Throwable;
use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface PermissionDeleteOutputPort
 * @package ConsulConfigManager\Users\UseCases\Permission\Delete
 */
interface PermissionDeleteOutputPort
{
    /**
     * Output port for "delete"
     * @param PermissionDeleteResponseModel $responseModel
     * @return ViewModel
     */
    public function delete(PermissionDeleteResponseModel $responseModel): ViewModel;

    /**
     * Output port for "not found"
     * @param PermissionDeleteResponseModel $responseModel
     * @return ViewModel
     */
    public function notFound(PermissionDeleteResponseModel $responseModel): ViewModel;

    /**
     * Output port for "internal server error"
     * @param PermissionDeleteResponseModel $responseModel
     * @param Throwable $throwable
     * @return ViewModel
     */
    public function internalServerError(PermissionDeleteResponseModel $responseModel, Throwable $throwable): ViewModel;
}
