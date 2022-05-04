<?php

namespace ConsulConfigManager\Users\UseCases\Permission\Create;

use ConsulConfigManager\Users\Http\Requests\Permission\PermissionCreateUpdateRequest;

/**
 * Class PermissionCreateRequestModel
 * @package ConsulConfigManager\Users\UseCases\Permission\Create
 */
class PermissionCreateRequestModel
{
    /**
     * Request instance
     * @var PermissionCreateUpdateRequest
     */
    private PermissionCreateUpdateRequest $request;

    /**
     * PermissionCreateRequestModel constructor.
     * @param PermissionCreateUpdateRequest $request
     * @return void
     */
    public function __construct(PermissionCreateUpdateRequest $request)
    {
        $this->request = $request;
    }

    /**
     * Get request instance
     * @return PermissionCreateUpdateRequest
     */
    public function getRequest(): PermissionCreateUpdateRequest
    {
        return $this->request;
    }
}
