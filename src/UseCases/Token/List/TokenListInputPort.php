<?php

namespace ConsulConfigManager\Users\UseCases\Token\List;

use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface TokenListInputPort
 * @package ConsulConfigManager\Users\UseCases\Token\List
 */
interface TokenListInputPort
{
    /**
     * Input port for "list"
     * @param TokenListRequestModel $requestModel
     * @return ViewModel
     */
    public function list(TokenListRequestModel $requestModel): ViewModel;
}
