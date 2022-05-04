<?php

namespace ConsulConfigManager\Users\UseCases\Permission\Get;

use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface PermissionGetInputPort
 * @package ConsulConfigManager\Users\UseCases\Permission\Get
 */
interface PermissionGetInputPort
{
    /**
     * Input port for "get"
     * @param PermissionGetRequestModel $requestModel
     * @return ViewModel
     */
    public function get(PermissionGetRequestModel $requestModel): ViewModel;
}
