<?php

namespace ConsulConfigManager\Users\UseCases\Permission\Create;

use Throwable;
use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface PermissionCreateOutputPort
 * @package ConsulConfigManager\Users\UseCases\Permission\Create
 */
interface PermissionCreateOutputPort
{
    /**
     * Output port for "create"
     * @param PermissionCreateResponseModel $responseModel
     * @return ViewModel
     */
    public function create(PermissionCreateResponseModel $responseModel): ViewModel;

    /**
     * Output port for "already exists"
     * @param PermissionCreateResponseModel $responseModel
     * @return ViewModel
     */
    public function alreadyExists(PermissionCreateResponseModel $responseModel): ViewModel;

    /**
     * Output port for "internal server error"
     * @param PermissionCreateResponseModel $responseModel
     * @param Throwable $throwable
     * @return ViewModel
     */
    public function internalServerError(PermissionCreateResponseModel $responseModel, Throwable $throwable): ViewModel;
}
