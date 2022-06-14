<?php

namespace ConsulConfigManager\Users\UseCases\User\Delete;

use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface UserDeleteInputPort
 *
 * @package ConsulConfigManager\Users\UseCases\User\Delete
 */
interface UserDeleteInputPort
{
    /**
     * Input port for "delete"
     * @param UserDeleteRequestModel $deleteUserRequestModel
     * @return ViewModel
     */
    public function delete(UserDeleteRequestModel $deleteUserRequestModel): ViewModel;
}
