<?php

namespace ConsulConfigManager\Users\Test\Unit\ValueObjects;

use DomainException;
use ConsulConfigManager\Users\Test\TestCase;
use ConsulConfigManager\Users\ValueObjects\EmailValueObject;

/**
 * Class EmailValueObjectTest
 *
 * @package ConsulConfigManager\Users\Test\Unit\ValueObjects
 */
class EmailValueObjectTest extends TestCase
{
    /**
     * @param string $email
     * @dataProvider emailDataProvider
     */
    public function testObjectCanBeCreatedWithValidEmail(string $email): void
    {
        $this->assertNotNull(new EmailValueObject($email));
    }

    public function testObjectCannotBeCreatedWithInvalidEmail(): void
    {
        $value = 'invalid.email';

        $this->expectException(DomainException::class);
        $this->expectExceptionMessage(sprintf(
            'Invalid E-Mail address - %s',
            $value
        ));

        new EmailValueObject($value);
    }

    /**
     * @param string $email
     * @dataProvider emailDataProvider
     */
    public function testObjectComparator(string $email): void
    {
        $instance = new EmailValueObject($email);
        $this->assertTrue($instance->isEqualTo(new EmailValueObject($email)));
    }

    /**
     * @param string $email
     * @dataProvider emailDataProvider
     */
    public function testObjectCanBeStringified(string $email): void
    {
        $instance = new EmailValueObject($email);
        $this->assertEquals($email, (string) $instance);
    }

    /**
     * @param string $email
     * @dataProvider emailDataProvider
     */
    public function testObjectCanBeJsonSerialized(string $email): void
    {
        $instance = new EmailValueObject($email);
        $this->assertEquals($email, $instance->jsonSerialize());
    }

    /**
     * Email data provider
     * @return array
     */
    public function emailDataProvider(): array
    {
        return [
            'Jessie Doe'    =>  [
                'data'      =>  'jessie.doe@example.com',
            ],
        ];
    }
}
