<?php

namespace ConsulConfigManager\Users\UseCases\Role\Create;

use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface RoleCreateInputPort
 * @package ConsulConfigManager\Users\UseCases\Role\Create
 */
interface RoleCreateInputPort
{
    /**
     * Input port for "create"
     * @param RoleCreateRequestModel $requestModel
     * @return ViewModel
     */
    public function create(RoleCreateRequestModel $requestModel): ViewModel;
}
