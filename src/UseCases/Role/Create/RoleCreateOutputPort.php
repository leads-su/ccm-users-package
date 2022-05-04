<?php

namespace ConsulConfigManager\Users\UseCases\Role\Create;

use Throwable;
use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface RoleCreateOutputPort
 * @package ConsulConfigManager\Users\UseCases\Role\Create
 */
interface RoleCreateOutputPort
{
    /**
     * Output port for "create"
     * @param RoleCreateResponseModel $responseModel
     * @return ViewModel
     */
    public function create(RoleCreateResponseModel $responseModel): ViewModel;

    /**
     * Output port for "already exists"
     * @param RoleCreateResponseModel $responseModel
     * @return ViewModel
     */
    public function alreadyExists(RoleCreateResponseModel $responseModel): ViewModel;

    /**
     * Output port for "internal server error"
     * @param RoleCreateResponseModel $responseModel
     * @param Throwable $throwable
     * @return ViewModel
     */
    public function internalServerError(RoleCreateResponseModel $responseModel, Throwable $throwable): ViewModel;
}
