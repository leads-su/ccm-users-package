<?php

namespace ConsulConfigManager\Users\UseCases\Role\Delete;

use Throwable;
use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface RoleDeleteOutputPort
 * @package ConsulConfigManager\Users\UseCases\Role\Delete
 */
interface RoleDeleteOutputPort
{
    /**
     * Output port for "delete"
     * @param RoleDeleteResponseModel $responseModel
     * @return ViewModel
     */
    public function delete(RoleDeleteResponseModel $responseModel): ViewModel;

    /**
     * Output port for "not found"
     * @param RoleDeleteResponseModel $responseModel
     * @return ViewModel
     */
    public function notFound(RoleDeleteResponseModel $responseModel): ViewModel;

    /**
     * Output port for "internal server error"
     * @param RoleDeleteResponseModel $responseModel
     * @param Throwable $throwable
     * @return ViewModel
     */
    public function internalServerError(RoleDeleteResponseModel $responseModel, Throwable $throwable): ViewModel;
}
