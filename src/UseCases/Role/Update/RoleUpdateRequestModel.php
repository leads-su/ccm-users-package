<?php

namespace ConsulConfigManager\Users\UseCases\Role\Update;

use ConsulConfigManager\Users\Http\Requests\Role\RoleCreateUpdateRequest;

/**
 * Class RoleUpdateRequestModel
 * @package ConsulConfigManager\Users\UseCases\Role\Update
 */
class RoleUpdateRequestModel
{
    /**
     * Request instance
     * @var RoleCreateUpdateRequest
     */
    private RoleCreateUpdateRequest $request;

    /**
     * Identifier string
     * @var string|int
     */
    private string|int $identifier;

    /**
     * RoleUpdateResponseModel constructor.
     * @param RoleCreateUpdateRequest $request
     * @param string|int $identifier
     * @return void
     */
    public function __construct(RoleCreateUpdateRequest $request, string|int $identifier)
    {
        $this->request = $request;
        $this->identifier = $identifier;
    }

    /**
     * Get request instance
     * @return RoleCreateUpdateRequest
     */
    public function getRequest(): RoleCreateUpdateRequest
    {
        return $this->request;
    }

    /**
     * Get identifier string
     * @return string|int
     */
    public function getIdentifier(): string|int
    {
        return $this->identifier;
    }
}
