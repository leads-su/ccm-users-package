<?php

namespace ConsulConfigManager\Users\Test\Unit\UseCases\Permission\Update;

use ConsulConfigManager\Users\Test\TestCase;
use ConsulConfigManager\Users\UseCases\Permission\Update\PermissionUpdateResponseModel;

/**
 * Class PermissionUpdateResponseModelTest
 * @package ConsulConfigManager\Users\Test\Unit\UseCases\Permission\Update
 */
class PermissionUpdateResponseModelTest extends TestCase
{
    /**
     * @return void
     */
    public function testShouldPassIfCanBeCreatedWithNull(): void
    {
        $instance = new PermissionUpdateResponseModel(null);
        $this->assertSame([], $instance->getEntity());
    }

    /**
     * @return void
     */
    public function testShouldPassIfCanBeCreatedWithArray(): void
    {
        $instance = new PermissionUpdateResponseModel([]);
        $this->assertSame([], $instance->getEntity());
    }
}
