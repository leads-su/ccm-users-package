<?php

namespace ConsulConfigManager\Users\Test\Unit\UseCases\User\Get;

use Illuminate\Http\Request;
use ConsulConfigManager\Users\Test\TestCase;
use ConsulConfigManager\Users\UseCases\User\Get\UserGetRequestModel;

/**
 * Class UserGetResponseModelTest
 * @package ConsulConfigManager\Users\Test\Unit\UseCases\User\Get
 */
class UserGetRequestModelTest extends TestCase
{
    /**
     * @return void
     */
    public function testShouldPassIfCanRetrieveRequest(): void
    {
        $request = request();
        $instance = new UserGetRequestModel($request, '123');
        $this->assertInstanceOf(Request::class, $instance->getRequest());
    }
}
