<?php

namespace ConsulConfigManager\Users\Test\Unit\Repositories;

use Illuminate\Support\Arr;
use Spatie\Permission\Contracts\Role;
use ConsulConfigManager\Users\Test\TestCase;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use ConsulConfigManager\Users\Interfaces\RoleRepositoryInterface;
use ConsulConfigManager\Users\Http\Requests\Role\RoleCreateUpdateRequest;

/**
 * Class RoleRepositoryTest
 * @package ConsulConfigManager\Users\Test\Unit\Repositories
 */
class RoleRepositoryTest extends TestCase
{
    /**
     * @param array $data
     * @return void
     * @dataProvider dataProvider
     */
    public function testShouldPassIfCanCreateNewRole(array $data): void
    {
        $request = $this->createRequestInstance($data);
        $response = $this->repository()->create($request);
        $this->assertInstanceOf(Role::class, $response);
    }

    /**
     * @param array $data
     * @return void
     * @dataProvider dataProvider
     */
    public function testShouldPassIfCanUpdateRole(array $data): void
    {
        $entity = $this->createRole($data);

        Arr::set($data, 'permissions', []);
        $request = $this->createRequestInstance($data);

        $this->repository()->update($entity->id, $request);

        Arr::set($data, 'guard_name', 'web');
        $request = $this->createRequestInstance($data);
        $response = $this->repository()->update($entity->id, $request);
        $this->assertSame('web', $response->guard_name);
    }

    /**
     * @param array $data
     * @return void
     * @dataProvider dataProvider
     */
    public function testShouldPassIfCanDeleteExistingRole(array $data): void
    {
        $this->createRole($data);
        $response = $this->repository()->delete(1);
        $this->assertTrue($response);
    }

    /**
     * @param array $data
     * @return void
     * @dataProvider dataProvider
     */
    public function testShouldPassIfCanForceDeleteExistingRole(array $data): void
    {
        $this->createRole($data);
        $response = $this->repository()->forceDelete(1);
        $this->assertTrue($response);
    }

    /**
     * @return void
     */
    public function testShouldPassIfFalseReturnedWhileDeletingNonExistentRole(): void
    {
        $response = $this->repository()->delete(100);
        $this->assertFalse($response);
    }

    /**
     * @return void
     */
    public function testShouldPassIfValidDataReturnedFromAllMethod(): void
    {
        $result = $this->repository()->all();
        $this->assertInstanceOf(Collection::class, $result);
        $this->assertCount(4, $result);
    }

    /**
     * @return void
     */
    public function testShouldPassIfValidDataReturnedFromFindByMethodWithoutFailForNonExisting(): void
    {
        $result = $this->repository()->findBy(field: 'id', value: 1, notFoundFail: false);
        $this->assertInstanceOf(Role::class, $result);
    }

    /**
     * @return void
     */
    public function testShouldPassIfValidDataReturnedFromFindByMethodWithFailForNonExisting(): void
    {
        $result = $this->repository()->findBy(field: 'id', value: 1, notFoundFail: true);
        $this->assertInstanceOf(Role::class, $result);
    }

    /**
     * @return void
     */
    public function testShouldPassIfValidDataReturnedFromFindByMethodForNonExistingWithoutFailForNonExisting(): void
    {
        $result = $this->repository()->findBy(field: 'id', value: 100, notFoundFail: false);
        $this->assertNull($result);
    }

    /**
     * @return void
     */
    public function testShouldPassIfValidDataReturnedFromFindByMethodForNonExistingWithFailForNonExisting(): void
    {
        $this->expectException(ModelNotFoundException::class);
        $this->repository()->findBy(field: 'id', value: 100, notFoundFail: true);
    }

    /**
     * @return void
     */
    public function testShouldPassIfValidDataReturnedFromFindByIdMethodWithoutFailForNonExisting(): void
    {
        $result = $this->repository()->findByID(id: 1, notFoundFail: false);
        $this->assertInstanceOf(Role::class, $result);
    }

    /**
     * @return void
     */
    public function testShouldPassIfValidDataReturnedFromFindByIdMethodWithFailForNonExisting(): void
    {
        $result = $this->repository()->findByID(id: 1, notFoundFail: true);
        $this->assertInstanceOf(Role::class, $result);
    }

    /**
     * @return void
     */
    public function testShouldPassIfValidDataReturnedFromFindByIdMethodForNonExistingWithoutFailForNonExisting(): void
    {
        $result = $this->repository()->findByID(id: 100, notFoundFail: false);
        $this->assertNull($result);
    }

    /**
     * @return void
     */
    public function testShouldPassIfValidDataReturnedFromFindByIdMethodForNonExistingWithFailForNonExisting(): void
    {
        $this->expectException(ModelNotFoundException::class);
        $this->repository()->findByID(id: 100, notFoundFail: true);
    }

    /**
     * Create new permission
     * @param array $data
     * @return Role
     */
    private function createRole(array $data): Role
    {
        return $this->repository()->create(
            $this->createRequestInstance($data)
        );
    }

    /**
     * Create request instance
     * @param array $data
     * @return RoleCreateUpdateRequest
     */
    private function createRequestInstance(array $data): RoleCreateUpdateRequest
    {
        $request = new RoleCreateUpdateRequest($data);
        $request->setContainer($this->app)->validateResolved();
        return $request;
    }

    /**
     * Create repository instance
     * @return RoleRepositoryInterface
     */
    private function repository(): RoleRepositoryInterface
    {
        return $this->app->make(RoleRepositoryInterface::class);
    }

    /**
     * Entity data provider
     * @return \string[][][]
     */
    public function dataProvider(): array
    {
        return [
            'example_role_entity'           =>  [
                'data'                      =>  [
                    'name'                  =>  'example_role',
                    'guard_name'            =>  'api',
                    'permissions'           =>  [1],
                ],
            ],
        ];
    }
}
