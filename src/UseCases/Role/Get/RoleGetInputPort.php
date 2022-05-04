<?php

namespace ConsulConfigManager\Users\UseCases\Role\Get;

use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface RoleGetInputPort
 * @package ConsulConfigManager\Users\UseCases\Role\Get
 */
interface RoleGetInputPort
{
    /**
     * Input port for "get"
     * @param RoleGetRequestModel $requestModel
     * @return ViewModel
     */
    public function get(RoleGetRequestModel $requestModel): ViewModel;
}
