<?php

namespace ConsulConfigManager\Users\Test\Unit\UseCases\User\Delete;

use ConsulConfigManager\Users\Test\TestCase;
use ConsulConfigManager\Users\UseCases\User\Delete\UserDeleteRequestModel;

/**
 * Class UserDeleteRequestModelTest
 * @package ConsulConfigManager\Users\Test\Unit\UseCases\User\Delete
 */
class UserDeleteRequestModelTest extends TestCase
{
    /**
     * @return void
     */
    public function testShouldPassIfValidValueReturnedFromGetRoleMethod(): void
    {
        $request = new UserDeleteRequestModel([
            'role'      =>  'test',
        ]);
        $this->assertSame('test', $request->getRole());
    }
}
