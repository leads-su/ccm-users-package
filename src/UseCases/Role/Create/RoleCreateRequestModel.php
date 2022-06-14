<?php

namespace ConsulConfigManager\Users\UseCases\Role\Create;

use ConsulConfigManager\Users\Http\Requests\Role\RoleCreateUpdateRequest;

/**
 * Class RoleCreateRequestModel
 * @package ConsulConfigManager\Users\UseCases\Role\Create
 */
class RoleCreateRequestModel
{
    /**
     * Request instance
     * @var RoleCreateUpdateRequest
     */
    private RoleCreateUpdateRequest $request;

    /**
     * RoleCreateRequestModel constructor.
     * @param RoleCreateUpdateRequest $request
     * @return void
     */
    public function __construct(RoleCreateUpdateRequest $request)
    {
        $this->request = $request;
    }

    /**
     * Get request instance
     * @return RoleCreateUpdateRequest
     */
    public function getRequest(): RoleCreateUpdateRequest
    {
        return $this->request;
    }
}
