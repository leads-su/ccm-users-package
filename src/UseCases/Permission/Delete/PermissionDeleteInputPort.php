<?php

namespace ConsulConfigManager\Users\UseCases\Permission\Delete;

use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface PermissionDeleteInputPort
 * @package ConsulConfigManager\Users\UseCases\Permission\Delete
 */
interface PermissionDeleteInputPort
{
    /**
     * Input port for "delete"
     * @param PermissionDeleteRequestModel $requestModel
     * @return ViewModel
     */
    public function delete(PermissionDeleteRequestModel $requestModel): ViewModel;
}
