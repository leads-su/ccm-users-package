<?php

namespace ConsulConfigManager\Users\UseCases\User\Get;

use Illuminate\Http\Request;

/**
 * Class UserGetRequestModel
 * @package ConsulConfigManager\Users\UseCases\User\Get
 */
class UserGetRequestModel
{
    /**
     * Request instance
     * @var Request
     */
    private Request $request;

    /**
     * Identifier string
     * @var string|int
     */
    private string|int $identifier;

    /**
     * UserGetRequestModel constructor.
     * @param Request $request
     * @param string|int $identifier
     * @return void
     */
    public function __construct(Request $request, string|int $identifier)
    {
        $this->request = $request;
        $this->identifier = $identifier;
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
     * Get identifier string
     * @return string
     */
    public function getIdentifier(): string
    {
        return $this->identifier;
    }
}
