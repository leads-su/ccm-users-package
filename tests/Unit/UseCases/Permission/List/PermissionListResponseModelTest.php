<?php

namespace ConsulConfigManager\Users\Test\Unit\UseCases\Permission\List;

use Illuminate\Support\Collection;
use ConsulConfigManager\Users\Test\TestCase;
use ConsulConfigManager\Users\UseCases\Permission\List\PermissionListResponseModel;

/**
 * Class PermissionListResponseModelTest
 * @package ConsulConfigManager\Users\Test\Unit\UseCases\Permission\List
 */
class PermissionListResponseModelTest extends TestCase
{
    /**
     * @return void
     */
    public function testShouldPassIfCanBeCreatedWithArray(): void
    {
        $instance = new PermissionListResponseModel([]);
        $this->assertInstanceOf(Collection::class, $instance->getEntities());
    }
}
