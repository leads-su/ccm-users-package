<?php

namespace ConsulConfigManager\Users\Test\Unit\UseCases\Role\List;

use Illuminate\Http\Request;
use ConsulConfigManager\Users\Test\TestCase;
use ConsulConfigManager\Users\UseCases\Role\List\RoleListRequestModel;

/**
 * Class RoleListResponseModelTest
 * @package ConsulConfigManager\Users\Test\Unit\UseCases\Role\List
 */
class RoleListRequestModelTest extends TestCase
{
    /**
     * @return void
     */
    public function testShouldPassIfCanRetrieveRequest(): void
    {
        $instance = new RoleListRequestModel(request());
        $this->assertInstanceOf(Request::class, $instance->getRequest());
    }
}
