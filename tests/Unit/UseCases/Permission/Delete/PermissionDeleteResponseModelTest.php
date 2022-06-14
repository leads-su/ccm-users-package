<?php

namespace ConsulConfigManager\Users\Test\Unit\UseCases\Permission\Delete;

use Spatie\Permission\Models\Permission;
use ConsulConfigManager\Users\Test\TestCase;
use ConsulConfigManager\Users\UseCases\Permission\Delete\PermissionDeleteResponseModel;

/**
 * Class PermissionDeleteResponseModelTest
 * @package ConsulConfigManager\Users\Test\Unit\UseCases\Permission\Delete
 */
class PermissionDeleteResponseModelTest extends TestCase
{
    /**
     * @return void
     */
    public function testShouldPassIfCanBeCreatedWithNull(): void
    {
        $instance = new PermissionDeleteResponseModel(null);
        $this->assertSame([], $instance->getEntity());
    }

    /**
     * @return void
     */
    public function testShouldPassIfCanBeCreatedWithArray(): void
    {
        $instance = new PermissionDeleteResponseModel([]);
        $this->assertSame([], $instance->getEntity());
    }

    /**
     * @return void
     */
    public function testShouldPassIfCanBeCreatedWithEntity(): void
    {
        $instance = new PermissionDeleteResponseModel(new Permission());
        $this->assertSame([
            'guard_name'        =>  'web',
        ], $instance->getEntity());
    }
}
