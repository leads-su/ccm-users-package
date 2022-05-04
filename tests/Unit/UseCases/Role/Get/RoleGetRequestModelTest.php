<?php

namespace ConsulConfigManager\Users\Test\Unit\UseCases\Role\Get;

use ConsulConfigManager\Users\Test\TestCase;
use ConsulConfigManager\Users\UseCases\Role\Get\RoleGetRequestModel;
use ConsulConfigManager\Users\Http\Requests\Role\RoleCreateUpdateRequest;

/**
 * Class RoleGetResponseModelTest
 * @package ConsulConfigManager\Users\Test\Unit\UseCases\Role\Get
 */
class RoleGetRequestModelTest extends TestCase
{
    /**
     * @return void
     */
    public function testShouldPassIfCanRetrieveRequest(): void
    {
        $request = new RoleCreateUpdateRequest();
        $instance = new RoleGetRequestModel($request, '123');
        $this->assertInstanceOf(RoleCreateUpdateRequest::class, $instance->getRequest());
    }
}
