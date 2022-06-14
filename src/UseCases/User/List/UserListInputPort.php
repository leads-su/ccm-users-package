<?php

namespace ConsulConfigManager\Users\UseCases\User\List;

use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface UserListInputPort
 * @package ConsulConfigManager\Users\UseCases\User\List
 */
interface UserListInputPort
{
    /**
     * Input port for "list"
     * @param UserListRequestModel $requestModel
     * @return ViewModel
     */
    public function list(UserListRequestModel $requestModel): ViewModel;
}
