<?php

namespace ConsulConfigManager\Users\Test\Unit\Repositories;

use Illuminate\Support\Arr;
use ConsulConfigManager\Users\Models\User;
use ConsulConfigManager\Users\Test\TestCase;
use ConsulConfigManager\Users\Factories\UserFactory;
use ConsulConfigManager\Users\Interfaces\UserInterface;
use ConsulConfigManager\Users\ValueObjects\EmailValueObject;
use ConsulConfigManager\Users\ValueObjects\PasswordValueObject;
use ConsulConfigManager\Users\ValueObjects\UsernameValueObject;
use ConsulConfigManager\Users\Interfaces\UserRepositoryInterface;
use ConsulConfigManager\Users\Exceptions\ValueObjectNotUsedException;
use ConsulConfigManager\Users\ValueObjects\HashedPasswordValueObject;

/**
 * Class UserRepositoryTest
 * @package ConsulConfigManager\Users\Test\Unit\Repositories
 */
class UserRepositoryTest extends TestCase
{
    /**
     * @param array $data
     * @dataProvider dataProvider
     * @return void
     */
    public function testShouldPassIfCanCreateNewEntry(array $data): void
    {
        $this->createEntity($data);
    }

    /**
     * @param array $data
     * @dataProvider dataProvider
     * @return void
     */
    public function testShouldPassIfCanUpdateExistingEntry(array $data): void
    {
        $createdEntity = $this->createEntity($data);

        Arr::set($data, 'username', 'jane.doe');
        $createdEntity->setUsernameAttribute('jane.doe');

        $entity = $this->repository()->update(
            $createdEntity->getID(),
            $createdEntity,
        );
        $this->assertSameReturned($entity, $data);
    }

    /**
     * @param array $data
     * @dataProvider dataProvider
     * @return void
     */
    public function testShouldPassIfValidDataReturnedFromAllRequest(array $data): void
    {
        $this->createEntity($data);
        $response = $this->repository()->all();
        $this->assertSameReturned($response->first(), $data);
    }

    /**
     * @param array $data
     * @dataProvider dataProvider
     * @return void
     */
    public function testShouldPassIfValidDataReturnedFromFindRequest(array $data): void
    {
        $this->createEntity($data);

        $response = $this->repository()->find(Arr::get($data, 'id'));
        $this->assertSameReturned($response, $data);
    }

    /**
     * @param array $data
     * @dataProvider dataProvider
     * @return void
     * @throws \ConsulConfigManager\Users\Exceptions\ValueObjectNotUsedException
     */
    public function testShouldPassIfValidDataReturnedFromFindByRequest(array $data): void
    {
        $this->createEntity($data);

        $response = $this->repository()->findBy('guid', Arr::get($data, 'guid'));
        $this->assertSameReturned($response, $data);
    }

    /**
     * @param array $data
     * @dataProvider dataProvider
     * @return void
     * @throws \ConsulConfigManager\Users\Exceptions\ValueObjectNotUsedException
     */
    public function testShouldPassIfValidDataReturnedFromFindByRequestWithUsername(array $data): void
    {
        $this->expectException(ValueObjectNotUsedException::class);
        $this->expectExceptionMessage('Please use `findByUsername` method.');
        $this->repository()->findBy('username', Arr::get($data, 'username'));
    }

    /**
     * @param array $data
     * @dataProvider dataProvider
     * @return void
     * @throws \ConsulConfigManager\Users\Exceptions\ValueObjectNotUsedException
     */
    public function testShouldPassIfValidDataReturnedFromFindByRequestWithEmail(array $data): void
    {
        $this->expectException(ValueObjectNotUsedException::class);
        $this->expectExceptionMessage('Please use `findByEmail` method.');
        $this->repository()->findBy('email', Arr::get($data, 'email'));
    }

    /**
     * @param array $data
     * @dataProvider dataProvider
     * @return void
     */
    public function testShouldPassIfValidDataReturnedFromFindByUsernameRequest(array $data): void
    {
        $this->createEntity($data);

        $response = $this->repository()->findByUsername(new UsernameValueObject(Arr::get($data, 'username')));
        $this->assertSameReturned($response, $data);
    }

    /**
     * @param array $data
     * @dataProvider dataProvider
     * @return void
     */
    public function testShouldPassIfValidDataReturnedFromFindByEmailRequest(array $data): void
    {
        $this->createEntity($data);

        $response = $this->repository()->findByEmail(new EmailValueObject(Arr::get($data, 'email')));
        $this->assertSameReturned($response, $data);
    }

    /**
     * @param array $data
     * @dataProvider dataProvider
     * @return void
     */
    public function testShouldPassIfValidDataReturnedFromExistsMethodAndItIsTrue(array $data): void
    {
        $this->createEntity($data);
        $entity = UserFactory::new()->make($data);
        $result = $this->repository()->exists($entity);
        $this->assertTrue($result);
    }

    /**
     * @param array $data
     * @dataProvider dataProvider
     * @return void
     */
    public function testShouldPassIfValidDataReturnedFromExistsMethodAndItIsFalse(array $data): void
    {
        $entity = UserFactory::new()->make($data);
        $result = $this->repository()->exists($entity);
        $this->assertFalse($result);
    }

    /**
     * @param array $data
     * @dataProvider dataProvider
     * @return void
     */
    public function testShouldPassIfValidDataReturnedFromDeleteMethodAndItIsTrue(array $data): void
    {
        $this->createEntity($data);
        $entity = UserFactory::new()->make($data);
        $result = $this->repository()->delete($entity);
        $this->assertTrue($result);
    }

    /**
     * @param array $data
     * @dataProvider dataProvider
     * @return void
     */
    public function testShouldPassIfValidDataReturnedFromDeleteMethodAndItIsFalse(array $data): void
    {
        $entity = UserFactory::new()->make($data);
        $result = $this->repository()->delete($entity);
        $this->assertFalse($result);
    }

    /**
     * @return void
     */
    public function testShouldPassIfNoUsersReturnedFromWithPermissionMethod(): void
    {
        $result = $this->repository()->withPermission('dashboard view');
        $this->assertCount(0, $result);
    }

    /**
     * @param array $data
     * @dataProvider dataProvider
     * @return void
     */
    public function testShouldPassIfOneUserReturnedFromWithPermissionMethod(array $data): void
    {
        $entity = $this->createEntity($data);
        $entity->assignRole('guest');

        $result = $this->repository()->withPermission('dashboard view');
        $this->assertCount(1, $result);
    }

    /**
     * Create new repository instance
     * @return UserRepositoryInterface
     */
    private function repository(): UserRepositoryInterface
    {
        return $this->app->make(UserRepositoryInterface::class);
    }

    /**
     * Create new entity
     * @param array $data
     * @return UserInterface
     */
    private function createEntity(array $data): UserInterface
    {
        $passwordObject = new PasswordValueObject(Arr::get($data, 'password'));
        $userObject = UserFactory::new()->make($data);

        $entity = $this->repository()->create($userObject, $passwordObject);
        $this->assertSameReturned($entity, $data);
        return $entity;
    }

    /**
     * Assert that data returned is the same as in array
     * @param UserInterface $entity
     * @param array $data
     * @return void
     */
    private function assertSameReturned(UserInterface $entity, array $data): void
    {
        $this->assertInstanceOf(User::class, $entity);
        $this->assertArrayHasKey('id', $entity);
        $this->assertSame(Arr::get($data, 'guid'), $entity->getGuid());
        $this->assertSame(Arr::get($data, 'domain'), $entity->getDomain());
        $this->assertSame(Arr::get($data, 'first_name'), $entity->getFirstName());
        $this->assertSame(Arr::get($data, 'last_name'), $entity->getLastName());
        $this->assertInstanceOf(EmailValueObject::class, $entity->getEmail());
        $this->assertSame($entity->getEmail()->__toString(), Arr::get($data, 'email'));
        $this->assertInstanceOf(UsernameValueObject::class, $entity->getUsername());
        $this->assertSame($entity->getUsername()->__toString(), Arr::get($data, 'username'));
        $this->assertInstanceOf(HashedPasswordValueObject::class, $entity->getPassword());
        $this->assertTrue($entity->getPassword()->check(new PasswordValueObject(Arr::get($data, 'password'))));
        $this->assertNotNull($entity->created_at);
        $this->assertNotNull($entity->updated_at);
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
}
