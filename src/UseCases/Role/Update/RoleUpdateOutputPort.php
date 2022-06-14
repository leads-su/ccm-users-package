<?php

namespace ConsulConfigManager\Users\UseCases\Role\Update;

use Throwable;
use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface RoleUpdateOutputPort
 * @package ConsulConfigManager\Users\UseCases\Role\Update
 */
interface RoleUpdateOutputPort
{
    /**
     * Output port for "update"
     * @param RoleUpdateResponseModel $responseModel
     * @return ViewModel
     */
    public function update(RoleUpdateResponseModel $responseModel): ViewModel;

    /**
     * Output port for "not found"
     * @param RoleUpdateResponseModel $responseModel
     * @return ViewModel
     */
    public function notFound(RoleUpdateResponseModel $responseModel): ViewModel;

    /**
     * Output port for "internal server error"
     * @param RoleUpdateResponseModel $responseModel
     * @param Throwable $throwable
     * @return ViewModel
     */
    public function internalServerError(RoleUpdateResponseModel $responseModel, Throwable $throwable): ViewModel;
}
