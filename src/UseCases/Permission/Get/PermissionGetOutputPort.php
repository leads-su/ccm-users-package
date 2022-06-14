<?php

namespace ConsulConfigManager\Users\UseCases\Permission\Get;

use Throwable;
use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface PermissionGetOutputPort
 * @package ConsulConfigManager\Users\UseCases\Permission\Get
 */
interface PermissionGetOutputPort
{
    /**
     * Output port for "get"
     * @param PermissionGetResponseModel $responseModel
     * @return ViewModel
     */
    public function get(PermissionGetResponseModel $responseModel): ViewModel;

    /**
     * Output port for "not found"
     * @param PermissionGetResponseModel $responseModel
     * @return ViewModel
     */
    public function notFound(PermissionGetResponseModel $responseModel): ViewModel;

    /**
     * Output port for "internal server error"
     * @param PermissionGetResponseModel $responseModel
     * @param Throwable $throwable
     * @return ViewModel
     */
    public function internalServerError(PermissionGetResponseModel $responseModel, Throwable $throwable): ViewModel;
}
