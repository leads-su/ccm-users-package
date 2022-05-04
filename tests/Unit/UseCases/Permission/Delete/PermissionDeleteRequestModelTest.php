<?php

namespace ConsulConfigManager\Users\Test\Unit\UseCases\Permission\Delete;

use Illuminate\Http\Request;
use ConsulConfigManager\Users\Test\TestCase;
use ConsulConfigManager\Users\UseCases\Permission\Delete\PermissionDeleteRequestModel;

/**
 * Class PermissionDeleteResponseModelTest
 * @package ConsulConfigManager\Users\Test\Unit\UseCases\Permission\Delete
 */
class PermissionDeleteRequestModelTest extends TestCase
{
    /**
     * @return void
     */
    public function testShouldPassIfCanRetrieveRequest(): void
    {
        $instance = new PermissionDeleteRequestModel(request(), '123');
        $this->assertInstanceOf(Request::class, $instance->getRequest());
    }
}
