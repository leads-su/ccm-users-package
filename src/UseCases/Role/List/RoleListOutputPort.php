<?php

namespace ConsulConfigManager\Users\UseCases\Role\List;

use Throwable;
use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface RoleListOutputPort
 * @package ConsulConfigManager\Users\UseCases\Role\List
 */
interface RoleListOutputPort
{
    /**
     * Output port for "list"
     * @param RoleListResponseModel $responseModel
     * @return ViewModel
     */
    public function list(RoleListResponseModel $responseModel): ViewModel;

    /**
     * Output port for "internal server error"
     * @param RoleListResponseModel $responseModel
     * @param Throwable $throwable
     * @return ViewModel
     */
    public function internalServerError(RoleListResponseModel $responseModel, Throwable $throwable): ViewModel;
}
