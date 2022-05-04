<?php

namespace ConsulConfigManager\Users\Test\Unit\UseCases\Permission\Get;

use ConsulConfigManager\Users\Test\TestCase;
use ConsulConfigManager\Users\UseCases\Permission\Get\PermissionGetRequestModel;
use ConsulConfigManager\Users\Http\Requests\Permission\PermissionCreateUpdateRequest;

/**
 * Class PermissionGetResponseModelTest
 * @package ConsulConfigManager\Users\Test\Unit\UseCases\Permission\Get
 */
class PermissionGetRequestModelTest extends TestCase
{
    /**
     * @return void
     */
    public function testShouldPassIfCanRetrieveRequest(): void
    {
        $request = new PermissionCreateUpdateRequest();
        $instance = new PermissionGetRequestModel($request, '123');
        $this->assertInstanceOf(PermissionCreateUpdateRequest::class, $instance->getRequest());
    }
}
