<?php

namespace ConsulConfigManager\Users\UseCases\User\List;

use Illuminate\Http\Request;

/**
 * Class UserListRequestModel
 * @package ConsulConfigManager\Users\UseCases\User\List
 */
class UserListRequestModel
{
    /**
     * Request instance
     * @var Request
     */
    private Request $request;

    /**
     * UserListRequestModel constructor.
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
