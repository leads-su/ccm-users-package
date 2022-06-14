<?php

namespace ConsulConfigManager\Users\Test\Unit\ValueObjects;

use DomainException;
use ConsulConfigManager\Users\Test\TestCase;
use ConsulConfigManager\Users\ValueObjects\UsernameValueObject;

/**
 * Class UsernameValueObjectTest
 *
 * @package ConsulConfigManager\Users\Test\Unit\ValueObjects
 */
class UsernameValueObjectTest extends TestCase
{
    /**
     * @param string $username
     * @dataProvider usernameDataProvider
     */
    public function testObjectCanBeCreatedWithValidUsername(string $username): void
    {
        $this->assertNotNull(new UsernameValueObject($username));
    }

    public function testObjectCannotBeCreatedWithInvalidUsername(): void
    {
        $value = 'usr';

        $this->expectException(DomainException::class);
        $this->expectExceptionMessage('Failed to validate username against regex.');

        new UsernameValueObject($value);
    }

    /**
     * @param string $username
     * @dataProvider usernameDataProvider
     */
    public function testObjectComparator(string $username): void
    {
        $instance = new UsernameValueObject($username);
        $this->assertTrue($instance->isEqualTo(new UsernameValueObject($username)));
    }

    /**
     * @param string $username
     * @dataProvider usernameDataProvider
     */
    public function testObjectCanBeStringified(string $username): void
    {
        $instance = new UsernameValueObject($username);
        $this->assertEquals($username, (string) $instance);
    }

    /**
     * @param string $username
     * @dataProvider usernameDataProvider
     */
    public function testObjectCanBeJsonSerialized(string $username): void
    {
        $instance = new UsernameValueObject($username);
        $this->assertEquals($username, $instance->jsonSerialize());
    }

    /**
     * Username data provider
     * @return array
     */
    public function usernameDataProvider(): array
    {
        return [
            'Jessie Doe'    =>  [
                'data'      =>  'jessie.doe',
            ],
        ];
    }
}
