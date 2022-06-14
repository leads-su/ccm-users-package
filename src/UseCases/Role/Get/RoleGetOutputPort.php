<?php

namespace ConsulConfigManager\Users\UseCases\Role\Get;

use Throwable;
use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface RoleGetOutputPort
 * @package ConsulConfigManager\Users\UseCases\Role\Get
 */
interface RoleGetOutputPort
{
    /**
     * Output port for "get"
     * @param RoleGetResponseModel $responseModel
     * @return ViewModel
     */
    public function get(RoleGetResponseModel $responseModel): ViewModel;

    /**
     * Output port for "not found"
     * @param RoleGetResponseModel $responseModel
     * @return ViewModel
     */
    public function notFound(RoleGetResponseModel $responseModel): ViewModel;

    /**
     * Output port for "internal server error"
     * @param RoleGetResponseModel $responseModel
     * @param Throwable $throwable
     * @return ViewModel
     */
    public function internalServerError(RoleGetResponseModel $responseModel, Throwable $throwable): ViewModel;
}
