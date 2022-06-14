<?php

namespace ConsulConfigManager\Users\UseCases\Permission\Update;

use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface PermissionUpdateInputPort
 * @package ConsulConfigManager\Users\UseCases\Permission\Update
 */
interface PermissionUpdateInputPort
{
    /**
     * Input port for "update"
     * @param PermissionUpdateRequestModel $requestModel
     * @return ViewModel
     */
    public function update(PermissionUpdateRequestModel $requestModel): ViewModel;
}
