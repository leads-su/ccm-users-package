<?php

namespace ConsulConfigManager\Users\UseCases\Token\Delete;

use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface TokenDeleteInputPort
 * @package ConsulConfigManager\Users\UseCases\Token\Delete
 */
interface TokenDeleteInputPort
{
    /**
     * Input port for "delete"
     * @param TokenDeleteRequestModel $requestModel
     * @return ViewModel
     */
    public function delete(TokenDeleteRequestModel $requestModel): ViewModel;
}
