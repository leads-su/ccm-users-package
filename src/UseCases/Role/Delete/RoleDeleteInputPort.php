<?php

namespace ConsulConfigManager\Users\UseCases\Role\Delete;

use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface RoleDeleteInputPort
 * @package ConsulConfigManager\Users\UseCases\Role\Delete
 */
interface RoleDeleteInputPort
{
    /**
     * Input port for "delete"
     * @param RoleDeleteRequestModel $requestModel
     * @return ViewModel
     */
    public function delete(RoleDeleteRequestModel $requestModel): ViewModel;
}
