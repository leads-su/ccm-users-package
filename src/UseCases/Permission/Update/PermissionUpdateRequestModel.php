<?php

namespace ConsulConfigManager\Users\UseCases\Permission\Update;

use ConsulConfigManager\Users\Http\Requests\Permission\PermissionCreateUpdateRequest;

/**
 * Class PermissionUpdateRequestModel
 * @package ConsulConfigManager\Users\UseCases\Permission\Update
 */
class PermissionUpdateRequestModel
{
    /**
     * Request instance
     * @var PermissionCreateUpdateRequest
     */
    private PermissionCreateUpdateRequest $request;

    /**
     * Identifier string
     * @var string|int
     */
    private string|int $identifier;

    /**
     * PermissionUpdateResponseModel constructor.
     * @param PermissionCreateUpdateRequest $request
     * @param string|int $identifier
     * @return void
     */
    public function __construct(PermissionCreateUpdateRequest $request, string|int $identifier)
    {
        $this->request = $request;
        $this->identifier = $identifier;
    }

    /**
     * Get request instance
     * @return PermissionCreateUpdateRequest
     */
    public function getRequest(): PermissionCreateUpdateRequest
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
