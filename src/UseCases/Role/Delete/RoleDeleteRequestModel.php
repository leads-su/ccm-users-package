<?php

namespace ConsulConfigManager\Users\UseCases\Role\Delete;

use Illuminate\Http\Request;

/**
 * Class RoleDeleteRequestModel
 * @package ConsulConfigManager\Users\UseCases\Role\Delete
 */
class RoleDeleteRequestModel
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
     * RoleDeleteRequestModel constructor.
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
     * Delete request instance
     * @return Request
     */
    public function getRequest(): Request
    {
        return $this->request;
    }

    /**
     * Delete identifier string
     * @return string
     */
    public function getIdentifier(): string
    {
        return $this->identifier;
    }
}
