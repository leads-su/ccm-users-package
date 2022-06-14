<?php

namespace ConsulConfigManager\Users\Test\Unit\Models;

use Illuminate\Support\Arr;
use ConsulConfigManager\Users\Models\User;
use ConsulConfigManager\Users\Test\TestCase;
use ConsulConfigManager\Users\Interfaces\UserInterface;
use ConsulConfigManager\Users\ValueObjects\EmailValueObject;
use ConsulConfigManager\Users\ValueObjects\PasswordValueObject;
use ConsulConfigManager\Users\ValueObjects\UsernameValueObject;
use ConsulConfigManager\Users\Interfaces\UserRepositoryInterface;
use ConsulConfigManager\Users\ValueObjects\HashedPasswordValueObject;

/**
 * Class UserTest
 * @package ConsulConfigManager\Users\Test\Unit\Models
 */
class UserTest extends TestCase
{
    /**
     * @param array $data
     * @return void
     * @dataProvider dataProvider
     */
    public function testShouldPassIfValidDataReturnedFromGetIdMethod(array $data): void
    {
        $response = $this->model($data)->getID();
        $this->assertEquals(Arr::get($data, 'id'), $response);
    }

    /**
     * @param array $data
     * @return void
     * @dataProvider dataProvider
     */
    public function testShouldPassIfValidDataReturnedFromSetIdMethod(array $data): void
    {
        $model = $this->model($data);
        $model->setID(2);
        $this->assertEquals(2, $model->getID());
    }

    /**
     * @param array $data
     * @return void
     * @dataProvider dataProvider
     */
    public function testShouldPassIfValidDataReturnedFromGetGuidMethod(array $data): void
    {
        $response = $this->model($data)->getGuid();
        $this->assertEquals(Arr::get($data, 'guid'), $response);
    }

    /**
     * @param array $data
     * @return void
     * @dataProvider dataProvider
     */
    public function testShouldPassIfValidDataReturnedFromGetGuidMethodWhenNull(array $data): void
    {
        $response = $this->model(data: $data, noLdap: true)->getGuid();
        $this->assertNull($response);
    }

    /**
     * @param array $data
     * @return void
     * @dataProvider dataProvider
     */
    public function testShouldPassIfValidDataReturnedFromSetGuidMethod(array $data): void
    {
        $model = $this->model($data);
        $model->setGuid('f9683d53-27d5-4bf2-bedc-cb33f0afa5c6');
        $this->assertEquals('f9683d53-27d5-4bf2-bedc-cb33f0afa5c6', $model->getGuid());
    }

    /**
     * @param array $data
     * @return void
     * @dataProvider dataProvider
     */
    public function testShouldPassIfValidDataReturnedFromGetDomainMethod(array $data): void
    {
        $response = $this->model($data)->getDomain();
        $this->assertEquals(Arr::get($data, 'domain'), $response);
    }

    /**
     * @param array $data
     * @return void
     * @dataProvider dataProvider
     */
    public function testShouldPassIfValidDataReturnedFromGetDomainMethodWhenNull(array $data): void
    {
        $response = $this->model(data: $data, noLdap: true)->getDomain();
        $this->assertNull($response);
    }

    /**
     * @param array $data
     * @return void
     * @dataProvider dataProvider
     */
    public function testShouldPassIfValidDataReturnedFromSetDomainMethod(array $data): void
    {
        $model = $this->model($data);
        $model->setDomain('new_domain');
        $this->assertEquals('new_domain', $model->getDomain());
    }

    /**
     * @param array $data
     * @return void
     * @dataProvider dataProvider
     */
    public function testShouldPassIfValidDataReturnedFromGetFirstNameMethod(array $data): void
    {
        $response = $this->model($data)->getFirstName();
        $this->assertEquals(Arr::get($data, 'first_name'), $response);
    }

    /**
     * @param array $data
     * @return void
     * @dataProvider dataProvider
     */
    public function testShouldPassIfValidDataReturnedFromSetFirstNameMethod(array $data): void
    {
        $model = $this->model($data);
        $model->setFirstName('Jane');
        $this->assertEquals('Jane', $model->getFirstName());
    }

    /**
     * @param array $data
     * @return void
     * @dataProvider dataProvider
     */
    public function testShouldPassIfValidDataReturnedFromGetLastNameMethod(array $data): void
    {
        $response = $this->model($data)->getLastName();
        $this->assertEquals(Arr::get($data, 'last_name'), $response);
    }

    /**
     * @param array $data
     * @return void
     * @dataProvider dataProvider
     */
    public function testShouldPassIfValidDataReturnedFromSetLastNameMethod(array $data): void
    {
        $model = $this->model($data);
        $model->setLastName('Deo');
        $this->assertEquals('Deo', $model->getLastName());
    }

    /**
     * @param array $data
     * @return void
     * @dataProvider dataProvider
     */
    public function testShouldPassIfValidDataReturnedFromGetUsernameMethod(array $data): void
    {
        $response = $this->model($data)->getUsername();
        $this->assertInstanceOf(UsernameValueObject::class, $response);
        $this->assertEquals(Arr::get($data, 'username'), $response);
    }

    /**
     * @param array $data
     * @return void
     * @dataProvider dataProvider
     */
    public function testShouldPassIfValidDataReturnedFromSetUsernameMethod(array $data): void
    {
        $model = $this->model($data);
        $model->setUsername(new UsernameValueObject('jane.doe'));
        $this->assertEquals('jane.doe', $model->getUsername());
    }

    /**
     * @param array $data
     * @return void
     * @dataProvider dataProvider
     */
    public function testShouldPassIfValidDataReturnedFromGetEmailMethod(array $data): void
    {
        $response = $this->model($data)->getEmail();
        $this->assertInstanceOf(EmailValueObject::class, $response);
        $this->assertEquals(Arr::get($data, 'email'), $response);
    }

    /**
     * @param array $data
     * @return void
     * @dataProvider dataProvider
     */
    public function testShouldPassIfValidDataReturnedFromSetEmailMethod(array $data): void
    {
        $model = $this->model($data);
        $model->setEmail(new EmailValueObject('jane.doe@example.com'));
        $this->assertEquals('jane.doe@example.com', $model->getEmail());
    }

    /**
     * @param array $data
     * @return void
     * @dataProvider dataProvider
     */
    public function testShouldPassIfValidDataReturnedFromGetPasswordMethod(array $data): void
    {
        $response = $this->model($data)->getPassword();
        $this->assertInstanceOf(HashedPasswordValueObject::class, $response);
        $this->assertTrue($response->check(new PasswordValueObject(Arr::get($data, 'password'))));
    }

    /**
     * @param array $data
     * @return void
     * @dataProvider dataProvider
     */
    public function testShouldPassIfValidDataReturnedFromSetPasswordMethod(array $data): void
    {
        $newPassword = new PasswordValueObject('Passw0rdExamp1e');

        $model = $this->model($data);
        $model->setPassword($newPassword);

        $response = $model->getPassword();
        $this->assertInstanceOf(HashedPasswordValueObject::class, $response);
        $this->assertTrue($response->check($newPassword));
    }

    /**
     * @param array $data
     * @return void
     * @dataProvider dataProvider
     */
    public function testShouldPassIfValidDataReturnedFromGetEmailAttributeMethod(array $data): void
    {
        $response = $this->model($data)->getEmailAttribute();
        $this->assertInstanceOf(EmailValueObject::class, $response);
        $this->assertEquals(Arr::get($data, 'email'), $response);
    }

    /**
     * @param array $data
     * @return void
     * @dataProvider dataProvider
     */
    public function testShouldPassIfValidDataReturnedFromSetEmailAttributeMethodFromValueObject(array $data): void
    {
        $model = $this->model($data);
        $model->setEmailAttribute(new EmailValueObject('jane.doe@example.com'));
        $this->assertEquals('jane.doe@example.com', $model->getEmail());
    }

    /**
     * @param array $data
     * @return void
     * @dataProvider dataProvider
     */
    public function testShouldPassIfValidDataReturnedFromSetEmailAttributeMethodFromString(array $data): void
    {
        $model = $this->model($data);
        $model->setEmailAttribute('jane.doe@example.com');
        $this->assertEquals('jane.doe@example.com', $model->getEmail());
    }

    /**
     * @param array $data
     * @return void
     * @dataProvider dataProvider
     */
    public function testShouldPassIfValidDataReturnedFromGetUsernameAttributeMethod(array $data): void
    {
        $response = $this->model($data)->getUsernameAttribute();
        $this->assertInstanceOf(UsernameValueObject::class, $response);
        $this->assertEquals(Arr::get($data, 'username'), $response);
    }

    /**
     * @param array $data
     * @return void
     * @dataProvider dataProvider
     */
    public function testShouldPassIfValidDataReturnedFromSetUsernameAttributeMethodFromValueObject(array $data): void
    {
        $model = $this->model($data);
        $model->setUsernameAttribute(new UsernameValueObject('jane.doe'));
        $this->assertEquals('jane.doe', $model->getUsername());
    }

    /**
     * @param array $data
     * @return void
     * @dataProvider dataProvider
     */
    public function testShouldPassIfValidDataReturnedFromSetUsernameAttributeMethodFromString(array $data): void
    {
        $model = $this->model($data);
        $model->setUsernameAttribute('jane.doe');
        $this->assertEquals('jane.doe', $model->getUsername());
    }

    /**
     * @param array $data
     * @return void
     * @dataProvider dataProvider
     */
    public function testShouldPassIfValidDataReturnedFromGetPasswordAttributeMethod(array $data): void
    {
        $response = $this->model($data)->getPasswordAttribute();
        $this->assertInstanceOf(HashedPasswordValueObject::class, $response);
        $this->assertTrue($response->check(new PasswordValueObject(Arr::get($data, 'password'))));
    }

    /**
     * @param array $data
     * @return void
     * @dataProvider dataProvider
     */
    public function testShouldPassIfValidDataReturnedFromSetPasswordAttributeMethodFromValueObject(array $data): void
    {
        $newPassword = new PasswordValueObject('Passw0rdExamp1e');

        $model = $this->model($data);
        $model->setPasswordAttribute($newPassword);

        $response = $model->getPassword();
        $this->assertInstanceOf(HashedPasswordValueObject::class, $response);
        $this->assertTrue($response->check($newPassword));
    }

    /**
     * @param array $data
     * @return void
     * @dataProvider dataProvider
     */
    public function testShouldPassIfValidDataReturnedFromSetPasswordAttributeMethodFromString(array $data): void
    {
        $model = $this->model($data);
        $model->setPasswordAttribute('Passw0rdExamp1e');

        $response = $model->getPassword();
        $this->assertInstanceOf(HashedPasswordValueObject::class, $response);
        $this->assertTrue($response->check(new PasswordValueObject('Passw0rdExamp1e')));
    }

    /**
     * @param array $data
     * @return void
     * @dataProvider dataProvider
     */
    public function testShouldPassIfValidDataReturnedFromGetScopesAttributeWithoutRole(array $data): void
    {
        $model = $this->model($data, true);
        $this->assertSame([], $model->getScopesAttribute());
    }

    /**
     * @param array $data
     * @return void
     * @dataProvider dataProvider
     */
    public function testShouldPassIfValidDataReturnedFromGetRoleAttributeWithoutRole(array $data): void
    {
        $model = $this->model($data, true);
        $this->assertSame('guest', $model->getRoleAttribute());
    }

    /**
     * @param array $data
     * @return void
     * @dataProvider dataProvider
     */
    public function testShouldPassIfValidDataReturnedFromGetScopesAttributeWithRole(array $data): void
    {
        $model = $this->model($data, true);
        $model->assignRole('administrator');
        $this->assertSame([
            'dashboard view',
            'consul kv',
            'consul kv view',
        ], $model->getScopesAttribute());
    }

    /**
     * @param array $data
     * @return void
     * @dataProvider dataProvider
     */
    public function testShouldPassIfValidDataReturnedFromGetRoleAttributeWithRole(array $data): void
    {
        $model = $this->model($data, true);
        $model->assignRole('administrator');
        $this->assertSame('administrator', $model->getRoleAttribute());
    }

    /**
     * @param array $data
     * @return void
     * @dataProvider dataProvider
     */
    public function testShouldPassIfValidDataReturnedFromGetRolesCountAttribute(array $data): void
    {
        $model = $this->model($data, true);
        $model->assignRole('administrator');
        $this->assertSame(1, $model->getRolesCountAttribute());
    }

    /**
     * @param array $data
     * @return void
     * @dataProvider dataProvider
     */
    public function testShouldPassIfValidDataReturnedFromGetPermissionsCountAttribute(array $data): void
    {
        $model = $this->model($data, true);
        $model->assignRole('administrator');
        $this->assertSame(3, $model->getPermissionsCountAttribute());
    }

    /**
     * Entity data provider
     * @return \array[][]
     */
    public function dataProvider(): array
    {
        return [
            'example_user_entity'       =>  [
                'data'                  =>  [
                    'id'                =>  1,
                    'guid'              =>  '60f57a6e-41f9-48b1-b429-e938715927a5',
                    'domain'            =>  'example',
                    'first_name'        =>  'John',
                    'last_name'         =>  'Doe',
                    'username'          =>  'john.doe',
                    'email'             =>  'john.doe@example.com',
                    'password'          =>  'Examp1ePassw0rd',
                    'role'              =>  'guest',
                ],
            ],
        ];
    }

    /**
     * Create model instance
     * @param array $data
     * @param bool $create
     * @param bool $noLdap
     * @return UserInterface
     */
    private function model(array $data, bool $create = false, bool $noLdap = false): UserInterface
    {
        if ($noLdap) {
            Arr::forget($data, 'domain');
            Arr::forget($data, 'guid');
        }

        if ($create) {
            Arr::forget($data, 'role');
            return User::factory()->create($data);
        }
        return User::factory()->make($data);
    }

    /**
     * Create instance of user repository
     * @return UserRepositoryInterface
     */
    private function repository(): UserRepositoryInterface
    {
        return $this->app->make(UserRepositoryInterface::class);
    }
}
