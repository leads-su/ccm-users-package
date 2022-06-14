<?php

namespace ConsulConfigManager\Users\Test\Unit\UseCases\Permission\List;

use Illuminate\Http\Request;
use ConsulConfigManager\Users\Test\TestCase;
use ConsulConfigManager\Users\UseCases\Permission\List\PermissionListRequestModel;

/**
 * Class PermissionListResponseModelTest
 * @package ConsulConfigManager\Users\Test\Unit\UseCases\Permission\List
 */
class PermissionListRequestModelTest extends TestCase
{
    /**
     * @return void
     */
    public function testShouldPassIfCanRetrieveRequest(): void
    {
        $instance = new PermissionListRequestModel(request());
        $this->assertInstanceOf(Request::class, $instance->getRequest());
    }
}
