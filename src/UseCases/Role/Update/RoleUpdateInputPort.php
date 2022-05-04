<?php

namespace ConsulConfigManager\Users\UseCases\Role\Update;

use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface RoleUpdateInputPort
 * @package ConsulConfigManager\Users\UseCases\Role\Update
 */
interface RoleUpdateInputPort
{
    /**
     * Input port for "update"
     * @param RoleUpdateRequestModel $requestModel
     * @return ViewModel
     */
    public function update(RoleUpdateRequestModel $requestModel): ViewModel;
}
