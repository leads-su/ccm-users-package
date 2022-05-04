<?php

namespace ConsulConfigManager\Users\Test\Unit\ValueObjects;

use DomainException;
use ConsulConfigManager\Users\Test\TestCase;
use ConsulConfigManager\Users\ValueObjects\PasswordValueObject;
use ConsulConfigManager\Users\ValueObjects\HashedPasswordValueObject;

/**
 * Class PasswordValueObjectTest
 *
 * @package ConsulConfigManager\Users\Test\Unit\ValueObjects
 */
class PasswordValueObjectTest extends TestCase
{
    /**
     * @return void
     */
    public function testObjectCanBeCreatedWithValidPassword(): void
    {
        $passwords = [
            'Gx28@s1w',
            'Gx28#s1w',
            'Gx28$s1w',
            'Gx28%s1w',
            'Gx28&s1w',
            'Gx281s1w',
            'Gx28as1w',
        ];

        foreach ($passwords as $password) {
            $this->assertNotNull(new PasswordValueObject($password));
        }
    }

    /**
     * @return void
     */
    public function testObjectCannotBeCreatedWithInvalidPassword(): void
    {
        $passwords = [
            '1234567',
            '12345678',
            'aaaaaaaa',
            'AAAAAAAA',
            '12345^78',
            'aaaaa^aa',
            'AAAAA^aa',
            '12345?78',
            'aaaaa?aa',
            'AAAAA?aa',
            '12345*78',
            'aaaaa*aa',
            'AAAAA*aa',
            '12345.78',
            'aaaaa.aa',
            'AAAAA.aa',
            '12345;78',
            'aaaaa;aa',
            'AAAAA;aa',
            '12345:78',
            'aaaaa:aa',
            'AAAAA:aa',
            '12345"78',
            'aaaaa"aa',
            'AAAAA"aa',
            "12345'78",
            "aaaaa'aa",
            "AAAAA'aa",
        ];

        foreach ($passwords as $password) {
            $this->expectException(DomainException::class);
            new PasswordValueObject($password);
        }
    }

    /**
     * @param string $password
     * @dataProvider passwordDataProvider
     */
    public function testObjectCanBeStringified(string $password): void
    {
        $instance = new PasswordValueObject($password);
        $this->assertEquals($password, (string) $instance);
    }

    /**
     * @param string $password
     * @dataProvider passwordDataProvider
     */
    public function testObjectCanBeJsonSerialized(string $password): void
    {
        $instance = new PasswordValueObject($password);
        $this->assertEquals($password, $instance->jsonSerialize());
    }

    /**
     * @param string $password
     * @dataProvider passwordDataProvider
     */
    public function testObjectCanBeHashed(string $password): void
    {
        $instance = new PasswordValueObject($password);
        $this->assertInstanceOf(HashedPasswordValueObject::class, $instance->hashed());
    }

    /**
     * Password data provider
     * @return array
     */
    public function passwordDataProvider(): array
    {
        return [
            'Jessie Doe'    =>  [
                'data'      =>  '1nsecurePassw0rd',
            ],
        ];
    }
}
