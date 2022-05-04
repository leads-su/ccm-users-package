<?php

namespace ConsulConfigManager\Users\UseCases\Permission\List;

use Illuminate\Http\Request;

/**
 * Class PermissionListRequestModel
 * @package ConsulConfigManager\Users\UseCases\Permission\List
 */
class PermissionListRequestModel
{
    /**
     * Request instance
     * @var Request
     */
    private Request $request;

    /**
     * PermissionListRequestModel constructor.
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
}
