<?php

namespace ConsulConfigManager\Users\UseCases\Role\List;

use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface RoleListInputPort
 * @package ConsulConfigManager\Users\UseCases\Role\List
 */
interface RoleListInputPort
{
    /**
     * Input port for "list"
     * @param RoleListRequestModel $requestModel
     * @return ViewModel
     */
    public function list(RoleListRequestModel $requestModel): ViewModel;
}
