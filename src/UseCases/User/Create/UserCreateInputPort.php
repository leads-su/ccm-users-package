<?php

namespace ConsulConfigManager\Users\UseCases\User\Create;

use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface UserCreateInputPort
 *
 * @package ConsulConfigManager\Users\UseCases\User\Create
 */
interface UserCreateInputPort
{
    /**
     * Input port for "create"
     * @param UserCreateRequestModel $createUserRequestModel
     * @return ViewModel
     */
    public function create(UserCreateRequestModel $createUserRequestModel): ViewModel;
}
