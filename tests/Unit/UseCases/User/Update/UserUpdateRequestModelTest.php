<?php

namespace ConsulConfigManager\Users\Test\Unit\UseCases\User\Update;

use ConsulConfigManager\Users\Test\TestCase;
use ConsulConfigManager\Users\UseCases\User\Update\UserUpdateRequestModel;

/**
 * Class UserUpdateRequestModelTest
 * @package ConsulConfigManager\Users\Test\Unit\UseCases\User\Update
 */
class UserUpdateRequestModelTest extends TestCase
{
    /**
     * @return void
     */
    public function testShouldPassIfValidValueReturnedFromGetPasswordMethod(): void
    {
        $request = new UserUpdateRequestModel([
            'password'  =>  'test',
        ]);
        $this->assertSame('test', $request->getPassword());
    }

    /**
     * @return void
     */
    public function testShouldPassIfValidValueReturnedFromGetRoleMethod(): void
    {
        $request = new UserUpdateRequestModel([
            'role'      =>  'test',
        ]);
        $this->assertSame('test', $request->getRole());
    }
}
