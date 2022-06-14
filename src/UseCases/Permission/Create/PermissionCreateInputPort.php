<?php

namespace ConsulConfigManager\Users\UseCases\Permission\Create;

use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface PermissionCreateInputPort
 * @package ConsulConfigManager\Users\UseCases\Permission\Create
 */
interface PermissionCreateInputPort
{
    /**
     * Input port for "create"
     * @param PermissionCreateRequestModel $requestModel
     * @return ViewModel
     */
    public function create(PermissionCreateRequestModel $requestModel): ViewModel;
}
