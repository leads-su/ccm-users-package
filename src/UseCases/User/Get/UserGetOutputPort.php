<?php

namespace ConsulConfigManager\Users\UseCases\User\Get;

use Throwable;
use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface UserGetOutputPort
 * @package ConsulConfigManager\Users\UseCases\User\Get
 */
interface UserGetOutputPort
{
    /**
     * Output port for "get"
     * @param UserGetResponseModel $responseModel
     * @return ViewModel
     */
    public function get(UserGetResponseModel $responseModel): ViewModel;

    /**
     * Output port for "not found"
     * @param UserGetResponseModel $responseModel
     * @return ViewModel
     */
    public function notFound(UserGetResponseModel $responseModel): ViewModel;

    /**
     * Output port for "internal server error"
     * @param UserGetResponseModel $responseModel
     * @param Throwable $throwable
     * @return ViewModel
     */
    public function internalServerError(UserGetResponseModel $responseModel, Throwable $throwable): ViewModel;
}
