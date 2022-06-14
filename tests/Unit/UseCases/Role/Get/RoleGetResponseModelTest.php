<?php

namespace ConsulConfigManager\Users\Test\Unit\UseCases\Role\Get;

use Spatie\Permission\Models\Role;
use ConsulConfigManager\Users\Test\TestCase;
use ConsulConfigManager\Users\UseCases\Role\Get\RoleGetResponseModel;

/**
 * Class RoleGetResponseModelTest
 * @package ConsulConfigManager\Users\Test\Unit\UseCases\Role\Get
 */
class RoleGetResponseModelTest extends TestCase
{
    /**
     * @return void
     */
    public function testShouldPassIfCanBeCreatedWithNull(): void
    {
        $instance = new RoleGetResponseModel(null);
        $this->assertSame([], $instance->getEntity());
    }

    /**
     * @return void
     */
    public function testShouldPassIfCanBeCreatedWithArray(): void
    {
        $instance = new RoleGetResponseModel([]);
        $this->assertSame([], $instance->getEntity());
    }

    /**
     * @return void
     */
    public function testShouldPassIfCanBeCreatedWithEntity(): void
    {
        $instance = new RoleGetResponseModel(new Role());
        $this->assertSame([
            'guard_name'    =>  'web',
        ], $instance->getEntity());
    }
}
