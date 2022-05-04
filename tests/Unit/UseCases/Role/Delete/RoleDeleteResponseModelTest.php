<?php

namespace ConsulConfigManager\Users\Test\Unit\UseCases\Role\Delete;

use Spatie\Permission\Models\Role;
use ConsulConfigManager\Users\Test\TestCase;
use ConsulConfigManager\Users\UseCases\Role\Delete\RoleDeleteResponseModel;

/**
 * Class RoleDeleteResponseModelTest
 * @package ConsulConfigManager\Users\Test\Unit\UseCases\Role\Delete
 */
class RoleDeleteResponseModelTest extends TestCase
{
    /**
     * @return void
     */
    public function testShouldPassIfCanBeCreatedWithNull(): void
    {
        $instance = new RoleDeleteResponseModel(null);
        $this->assertSame([], $instance->getEntity());
    }

    /**
     * @return void
     */
    public function testShouldPassIfCanBeCreatedWithArray(): void
    {
        $instance = new RoleDeleteResponseModel([]);
        $this->assertSame([], $instance->getEntity());
    }

    /**
     * @return void
     */
    public function testShouldPassIfCanBeCreatedWithEntity(): void
    {
        $instance = new RoleDeleteResponseModel(new Role());
        $this->assertSame([
            'guard_name'        =>  'web',
        ], $instance->getEntity());
    }
}
