<?php

namespace ConsulConfigManager\Users\Test\Unit\ValueObjects;

use DomainException;
use Illuminate\Support\Arr;
use ConsulConfigManager\Users\Test\TestCase;
use ConsulConfigManager\Users\ValueObjects\PasswordValueObject;
use ConsulConfigManager\Users\ValueObjects\HashedPasswordValueObject;

/**
 * Class HashedPasswordValueObjectTest
 *
 * @package ConsulConfigManager\Users\Test\Unit\ValueObjects
 */
class HashedPasswordValueObjectTest extends TestCase
{
    private static string $rawPassword = '1nsecurePassw0rd';

    private static string $hashedPassword = '$2y$10$tOoF3OGK9vRzrxrq2FQs5.kIa7xSbU4lGMt1ntJwV/78dqhqb969O';

    /**
     * @param string $password
     * @dataProvider hashedPasswordDataProvider
     */
    public function testObjectCanBeCreatedWithValidPassword(string $password): void
    {
        $this->assertNotNull(new HashedPasswordValueObject($password));
    }

    /**
     * @param string $password
     * @dataProvider passwordDataProvider
     */
    public function testObjectCannotBeCreatedWithInvalidPassword(string $password): void
    {
        $this->expectException(DomainException::class);
        $this->expectExceptionMessage('Supplied value is not a hashed password.');

        new HashedPasswordValueObject($password);
    }

    /**
     * @param string $password
     * @dataProvider hashedPasswordDataProvider
     */
    public function testObjectComparator(string $password): void
    {
        $instance = new HashedPasswordValueObject($password);
        $this->assertTrue($instance->isEqualTo(new HashedPasswordValueObject($password)));
    }

    /**
     * @param array $passwords
     * @dataProvider combinedPasswordProvider
     */
    public function testObjectRawToHashedComparator(array $passwords): void
    {
        $rawPassword = Arr::get($passwords, 'raw');
        $hashedPassword = Arr::get($passwords, 'hashed');

        $rawInstance = new PasswordValueObject($rawPassword);
        $hashedInstance = new HashedPasswordValueObject($hashedPassword);

        $this->assertTrue($hashedInstance->check($rawInstance));
    }

    /**
     * @param string $password
     * @dataProvider passwordDataProvider
     */
    public function testObjectCreationFromStatic(string $password): void
    {
        $rawInstance = new PasswordValueObject($password);
        $this->assertInstanceOf(HashedPasswordValueObject::class, HashedPasswordValueObject::hash($rawInstance));
    }

    /**
     * @param string $password
     * @dataProvider hashedPasswordDataProvider
     */
    public function testObjectCanBeStringified(string $password): void
    {
        $instance = new HashedPasswordValueObject($password);
        $this->assertEquals($password, (string) $instance);
    }

    /**
     * @param string $password
     * @dataProvider hashedPasswordDataProvider
     */
    public function testObjectCanBeJsonSerialized(string $password): void
    {
        $instance = new HashedPasswordValueObject($password);
        $this->assertEquals($password, $instance->jsonSerialize());
    }

    /**
     * Password data provider
     * @return array
     */
    public function passwordDataProvider(): array
    {
        return [
            'Jessie Doe'    =>  [
                'data'      =>  self::$rawPassword,
            ],
        ];
    }

    /**
     * Hashed password data provider
     * @return array
     */
    public function hashedPasswordDataProvider(): array
    {
        return [
            'Jessie Doe'    =>  [
                'data'      =>  self::$hashedPassword,
            ],
        ];
    }

    /**
     * Raw and hashed password data provider
     * @return \array[][]
     */
    public function combinedPasswordProvider(): array
    {
        return [
            'Jessie Doe'        =>  [
                'data'          =>  [
                    'raw'       =>  self::$rawPassword,
                    'hashed'    =>  self::$hashedPassword,
                ],
            ],
        ];
    }
}
