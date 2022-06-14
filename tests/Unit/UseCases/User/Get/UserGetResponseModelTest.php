<?php

namespace ConsulConfigManager\Users\Test\Unit\UseCases\User\Get;

use ConsulConfigManager\Users\Models\User;
use ConsulConfigManager\Users\Test\TestCase;
use ConsulConfigManager\Users\UseCases\User\Get\UserGetResponseModel;

/**
 * Class UserGetResponseModelTest
 * @package ConsulConfigManager\Users\Test\Unit\UseCases\User\Get
 */
class UserGetResponseModelTest extends TestCase
{
    /**
     * @return void
     */
    public function testShouldPassIfCanBeCreatedWithNull(): void
    {
        $instance = new UserGetResponseModel(null);
        $this->assertSame([], $instance->getEntity());
    }

    /**
     * @return void
     */
    public function testShouldPassIfCanBeCreatedWithArray(): void
    {
        $instance = new UserGetResponseModel([]);
        $this->assertSame([], $instance->getEntity());
    }

    /**
     * @return void
     */
    public function testShouldPassIfCanBeCreatedWithEntity(): void
    {
        $instance = new UserGetResponseModel(new User());
        $this->assertSame([], $instance->getEntity());
    }
}
