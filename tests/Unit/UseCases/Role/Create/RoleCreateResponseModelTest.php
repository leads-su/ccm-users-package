<?php

namespace ConsulConfigManager\Users\Test\Unit\UseCases\Role\Create;

use ConsulConfigManager\Users\Test\TestCase;
use ConsulConfigManager\Users\UseCases\Role\Create\RoleCreateResponseModel;

/**
 * Class RoleCreateResponseModelTest
 * @package ConsulConfigManager\Users\Test\Unit\UseCases\Role\Create
 */
class RoleCreateResponseModelTest extends TestCase
{
    /**
     * @return void
     */
    public function testShouldPassIfCanBeCreatedWithNull(): void
    {
        $instance = new RoleCreateResponseModel(null);
        $this->assertSame([], $instance->getEntity());
    }

    /**
     * @return void
     */
    public function testShouldPassIfCanBeCreatedWithArray(): void
    {
        $instance = new RoleCreateResponseModel([]);
        $this->assertSame([], $instance->getEntity());
    }
}
