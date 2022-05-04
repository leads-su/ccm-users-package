<?php

namespace ConsulConfigManager\Users\UseCases\Role\Get;

use Illuminate\Http\Request;

/**
 * Class RoleGetRequestModel
 * @package ConsulConfigManager\Users\UseCases\Role\Get
 */
class RoleGetRequestModel
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
     * RoleGetRequestModel constructor.
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
