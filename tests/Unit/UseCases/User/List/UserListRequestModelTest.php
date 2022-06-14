<?php

namespace ConsulConfigManager\Users\Test\Unit\UseCases\User\List;

use Illuminate\Http\Request;
use ConsulConfigManager\Users\Test\TestCase;
use ConsulConfigManager\Users\UseCases\User\List\UserListRequestModel;

/**
 * Class UserListResponseModelTest
 * @package ConsulConfigManager\Users\Test\Unit\UseCases\User\List
 */
class UserListRequestModelTest extends TestCase
{
    /**
     * @return void
     */
    public function testShouldPassIfCanRetrieveRequest(): void
    {
        $request = request();
        $instance = new UserListRequestModel($request);
        $this->assertInstanceOf(Request::class, $instance->getRequest());
    }
}
