<?php

namespace ConsulConfigManager\Users\UseCases\User\Get;

use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface UserGetInputPort
 * @package ConsulConfigManager\Users\UseCases\User\Get
 */
interface UserGetInputPort
{
    /**
     * Input port for "get"
     * @param UserGetRequestModel $requestModel
     * @return ViewModel
     */
    public function get(UserGetRequestModel $requestModel): ViewModel;
}
