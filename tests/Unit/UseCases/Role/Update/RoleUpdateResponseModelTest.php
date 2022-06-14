<?php

namespace ConsulConfigManager\Users\Test\Unit\UseCases\Role\Update;

use Spatie\Permission\Models\Role;
use ConsulConfigManager\Users\Test\TestCase;
use ConsulConfigManager\Users\UseCases\Role\Update\RoleUpdateResponseModel;

/**
 * Class RoleUpdateResponseModelTest
 * @package ConsulConfigManager\Users\Test\Unit\UseCases\Role\Update
 */
class RoleUpdateResponseModelTest extends TestCase
{
    /**
     * @return void
     */
    public function testShouldPassIfCanBeCreatedWithNull(): void
    {
        $instance = new RoleUpdateResponseModel(null);
        $this->assertSame([], $instance->getEntity());
    }

    /**
     * @return void
     */
    public function testShouldPassIfCanBeCreatedWithArray(): void
    {
        $instance = new RoleUpdateResponseModel([]);
        $this->assertSame([], $instance->getEntity());
    }

    /**
     * @return void
     */
    public function testShouldPassIfCanBeCreatedWithEntity(): void
    {
        $instance = new RoleUpdateResponseModel(new Role());
        $this->assertSame([
            'guard_name'    =>  'web',
        ], $instance->getEntity());
    }
}
