<?php

namespace ConsulConfigManager\Users\UseCases\Permission\List;

use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface PermissionListInputPort
 * @package ConsulConfigManager\Users\UseCases\Permission\List
 */
interface PermissionListInputPort
{
    /**
     * Input port for "list"
     * @param PermissionListRequestModel $requestModel
     * @return ViewModel
     */
    public function list(PermissionListRequestModel $requestModel): ViewModel;
}
