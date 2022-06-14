<?php

namespace ConsulConfigManager\Users\Test\Unit\Models;

use ConsulConfigManager\Users\Models\ADUser;
use ConsulConfigManager\Users\Test\TestCase;

/**
 * Class ADUserTest
 *
 * @package ConsulConfigManager\Users\Test\Unit\Models
 */
class ADUserTest extends TestCase
{
    public function testShouldPassIfArrayIsReturned(): void
    {
        $user = new ADUser();
        $this->assertIsArray($user->toArray());
    }

    public function testShouldPassIfHiddenParametersAreNotInArray(): void
    {
        $user = new ADUser([
            'user'          =>  'test.user',
            'objectclass'   =>  'objectclass',
            'objectguid'    =>  'objectguid',
            'objectsid'     =>  'objectsid',
        ]);
        $array = $user->toArray();
        $hidden = $user->getHidden();
        foreach ($hidden as $item) {
            $this->assertArrayNotHasKey($item, $array);
        }
    }
}
