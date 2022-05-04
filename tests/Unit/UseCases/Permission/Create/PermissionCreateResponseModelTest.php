<?php

namespace ConsulConfigManager\Users\Test\Unit\UseCases\Permission\Create;

use ConsulConfigManager\Users\Test\TestCase;
use ConsulConfigManager\Users\UseCases\Permission\Create\PermissionCreateResponseModel;

/**
 * Class PermissionCreateResponseModelTest
 * @package ConsulConfigManager\Users\Test\Unit\UseCases\Permission\Create
 */
class PermissionCreateResponseModelTest extends TestCase
{
    /**
     * @return void
     */
    public function testShouldPassIfCanBeCreatedWithNull(): void
    {
        $instance = new PermissionCreateResponseModel(null);
        $this->assertSame([], $instance->getEntity());
    }

    /**
     * @return void
     */
    public function testShouldPassIfCanBeCreatedWithArray(): void
    {
        $instance = new PermissionCreateResponseModel([]);
        $this->assertSame([], $instance->getEntity());
    }
}
