<?php

namespace ConsulConfigManager\Users\Test\Unit\UseCases\User\Create;

use ConsulConfigManager\Users\Test\TestCase;
use ConsulConfigManager\Users\UseCases\User\Create\UserCreateRequestModel;

/**
 * Class UserCreateRequestModelTest
 * @package ConsulConfigManager\Users\Test\Unit\UseCases\User\Create
 */
class UserCreateRequestModelTest extends TestCase
{
    /**
     * @return void
     */
    public function testShouldPassIfValidValueReturnedFromGetRoleMethod(): void
    {
        $request = new UserCreateRequestModel([
            'role'      =>  'test',
        ]);
        $this->assertSame('test', $request->getRole());
    }
}
