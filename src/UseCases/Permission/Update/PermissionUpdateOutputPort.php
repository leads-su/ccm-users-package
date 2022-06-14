<?php

namespace ConsulConfigManager\Users\UseCases\Permission\Update;

use Throwable;
use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface PermissionUpdateOutputPort
 * @package ConsulConfigManager\Users\UseCases\Permission\Update
 */
interface PermissionUpdateOutputPort
{
    /**
     * Output port for "update"
     * @param PermissionUpdateResponseModel $responseModel
     * @return ViewModel
     */
    public function update(PermissionUpdateResponseModel $responseModel): ViewModel;

    /**
     * Output port for "not found"
     * @param PermissionUpdateResponseModel $responseModel
     * @return ViewModel
     */
    public function notFound(PermissionUpdateResponseModel $responseModel): ViewModel;

    /**
     * Output port for "internal server error"
     * @param PermissionUpdateResponseModel $responseModel
     * @param Throwable $throwable
     * @return ViewModel
     */
    public function internalServerError(PermissionUpdateResponseModel $responseModel, Throwable $throwable): ViewModel;
}
