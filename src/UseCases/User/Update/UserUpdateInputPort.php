<?php

namespace ConsulConfigManager\Users\UseCases\User\Update;

use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface UserUpdateInputPort
 *
 * @package ConsulConfigManager\Users\UseCases\User\Update
 */
interface UserUpdateInputPort
{
    /**
     * Input port for "update"
     * @param UserUpdateRequestModel $updateUserRequestModel
     * @return ViewModel
     */
    public function update(UserUpdateRequestModel $updateUserRequestModel): ViewModel;
}
