<?php

namespace ConsulConfigManager\Users\UseCases\Token\List;

use Illuminate\Http\Request;
use ConsulConfigManager\Users\Interfaces\UserInterface;

/**
 * Class TokenListRequestModel
 * @package ConsulConfigManager\Users\UseCases\Token\List
 */
class TokenListRequestModel
{
    /**
     * Request instance
     * @var Request
     */
    private Request $request;

    /**
     * TokenListRequestModel constructor.
     * @param Request $request
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Get request instance
     * @return Request
     */
    public function getRequest(): Request
    {
        return $this->request;
    }

    /**
     * Get user instance
     * @return UserInterface|null
     */
    public function getUser(): ?UserInterface
    {
        return $this->getRequest()->user();
    }
}
