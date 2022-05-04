<?php

namespace ConsulConfigManager\Users\Test\Unit\UseCases\Permission\Get;

use ConsulConfigManager\Users\Test\TestCase;
use ConsulConfigManager\Users\UseCases\Permission\Get\PermissionGetResponseModel;

/**
 * Class PermissionGetResponseModelTest
 * @package ConsulConfigManager\Users\Test\Unit\UseCases\Permission\Get
 */
class PermissionGetResponseModelTest extends TestCase
{
    /**
     * @return void
     */
    public function testShouldPassIfCanBeCreatedWithNull(): void
    {
        $instance = new PermissionGetResponseModel(null);
        $this->assertSame([], $instance->getEntity());
    }

    /**
     * @return void
     */
    public function testShouldPassIfCanBeCreatedWithArray(): void
    {
        $instance = new PermissionGetResponseModel([]);
        $this->assertSame([], $instance->getEntity());
    }
}
