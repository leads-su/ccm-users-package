<?php

namespace ConsulConfigManager\Users\Test\Unit\UseCases\Role\List;

use Illuminate\Support\Collection;
use ConsulConfigManager\Users\Test\TestCase;
use ConsulConfigManager\Users\UseCases\Role\List\RoleListResponseModel;

/**
 * Class RoleListResponseModelTest
 * @package ConsulConfigManager\Users\Test\Unit\UseCases\Role\List
 */
class RoleListResponseModelTest extends TestCase
{
    /**
     * @return void
     */
    public function testShouldPassIfCanBeCreatedWithArray(): void
    {
        $instance = new RoleListResponseModel([]);
        $this->assertInstanceOf(Collection::class, $instance->getEntities());
    }
}
