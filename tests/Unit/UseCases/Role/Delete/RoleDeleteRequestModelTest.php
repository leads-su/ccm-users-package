<?php

namespace ConsulConfigManager\Users\Test\Unit\UseCases\Role\Delete;

use Illuminate\Http\Request;
use ConsulConfigManager\Users\Test\TestCase;
use ConsulConfigManager\Users\UseCases\Role\Delete\RoleDeleteRequestModel;

/**
 * Class RoleDeleteResponseModelTest
 * @package ConsulConfigManager\Users\Test\Unit\UseCases\Role\Delete
 */
class RoleDeleteRequestModelTest extends TestCase
{
    /**
     * @return void
     */
    public function testShouldPassIfCanRetrieveRequest(): void
    {
        $instance = new RoleDeleteRequestModel(request(), '123');
        $this->assertInstanceOf(Request::class, $instance->getRequest());
    }
}
