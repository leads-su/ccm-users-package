<?php

namespace ConsulConfigManager\Users\Test\Unit\Repositories;

use Illuminate\Support\Arr;
use Spatie\Permission\Contracts\Permission;
use ConsulConfigManager\Users\Test\TestCase;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use ConsulConfigManager\Users\Interfaces\PermissionRepositoryInterface;
use ConsulConfigManager\Users\Http\Requests\Permission\PermissionCreateUpdateRequest;

/**
 * Class PermissionRepositoryTest
 * @package ConsulConfigManager\Users\Test\Unit\Repositories
 */
class PermissionRepositoryTest extends TestCase
{
    /**
     * @param array $data
     * @return void
     * @dataProvider dataProvider
     */
    public function testShouldPassIfCanCreateNewPermission(array $data): void
    {
        $request = $this->createRequestInstance($data);
        $response = $this->repository()->create($request);
        $this->assertInstanceOf(Permission::class, $response);
    }

    /**
     * @param array $data
     * @return void
     * @dataProvider dataProvider
     */
    public function testShouldPassIfCanUpdatePermission(array $data): void
    {
        $entity = $this->createPermission($data);

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
    public function testShouldPassIfCanDeleteExistingPermission(array $data): void
    {
        $this->createPermission($data);
        $response = $this->repository()->delete(1);
        $this->assertTrue($response);
    }

    /**
     * @param array $data
     * @return void
     * @dataProvider dataProvider
     */
    public function testShouldPassIfCanForceDeleteExistingPermission(array $data): void
    {
        $this->createPermission($data);
        $response = $this->repository()->forceDelete(1);
        $this->assertTrue($response);
    }

    /**
     * @return void
     */
    public function testShouldPassIfFalseReturnedWhileDeletingNonExistentPermission(): void
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
        $this->assertCount(3, $result);
    }

    /**
     * @return void
     */
    public function testShouldPassIfValidDataReturnedFromFindByMethodWithoutFailForNonExisting(): void
    {
        $result = $this->repository()->findBy(field: 'id', value: 1, notFoundFail: false);
        $this->assertInstanceOf(Permission::class, $result);
    }

    /**
     * @return void
     */
    public function testShouldPassIfValidDataReturnedFromFindByMethodWithFailForNonExisting(): void
    {
        $result = $this->repository()->findBy(field: 'id', value: 1, notFoundFail: true);
        $this->assertInstanceOf(Permission::class, $result);
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
        $this->assertInstanceOf(Permission::class, $result);
    }

    /**
     * @return void
     */
    public function testShouldPassIfValidDataReturnedFromFindByIdMethodWithFailForNonExisting(): void
    {
        $result = $this->repository()->findByID(id: 1, notFoundFail: true);
        $this->assertInstanceOf(Permission::class, $result);
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
     * @return Permission
     */
    private function createPermission(array $data): Permission
    {
        return $this->repository()->create(
            $this->createRequestInstance($data)
        );
    }

    /**
     * Create request instance
     * @param array $data
     * @return PermissionCreateUpdateRequest
     */
    private function createRequestInstance(array $data): PermissionCreateUpdateRequest
    {
        $request = new PermissionCreateUpdateRequest($data);
        $request->setContainer($this->app)->validateResolved();
        return $request;
    }

    /**
     * Create repository instance
     * @return PermissionRepositoryInterface
     */
    private function repository(): PermissionRepositoryInterface
    {
        return $this->app->make(PermissionRepositoryInterface::class);
    }

    /**
     * Entity data provider
     * @return \string[][][]
     */
    public function dataProvider(): array
    {
        return [
            'example_permission_entity'     =>  [
                'data'                      =>  [
                    'name'                  =>  'example permission',
                    'guard_name'            =>  'api',
                ],
            ],
        ];
    }
}
