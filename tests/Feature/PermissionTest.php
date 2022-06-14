<?php

namespace ConsulConfigManager\Users\Test\Feature;

use Illuminate\Support\Arr;
use Illuminate\Http\Response;
use Illuminate\Testing\TestResponse;
use Spatie\Permission\Contracts\Permission;
use ConsulConfigManager\Users\Test\TestCase;
use ConsulConfigManager\Users\Interfaces\PermissionRepositoryInterface;

/**
 * Class PermissionTest
 * @package ConsulConfigManager\Users\Test\Feature
 */
class PermissionTest extends TestCase
{
    /**
     * @param array $data
     * @return void
     * @dataProvider dataProvider
     */
    public function testShouldPassIfCanCreatePermission(array $data): void
    {
        $response = $this->post('/permissions', $data);
        $response->assertStatus(Response::HTTP_CREATED);
        $this->validateCreatedPermission($response, $data);
    }

    /**
     * @param array $data
     * @return void
     * @dataProvider dataProvider
     */
    public function testShouldPassIfCannotCreatePermissionWithSameName(array $data): void
    {
        $response = $this->post('/permissions', $data);
        $response->assertStatus(Response::HTTP_CREATED);
        $this->validateCreatedPermission($response, $data);

        $response = $this->post('/permissions', $data);
        $response->assertStatus(Response::HTTP_BAD_REQUEST);
        $this->assertSame('Permission with provided name already exists', $response->json('message'));
    }

    /**
     * @param array $data
     * @return void
     * @dataProvider dataProvider
     */
    public function testShouldPassIfCanUpdateExistingPermission(array $data): void
    {
        $identifier = $this->getCreatedPermissionID($data, true);
        $modelBeforeUpdate = $this->getPermissionModel($identifier);
        $this->assertSame('api', $modelBeforeUpdate->guard_name);

        Arr::set($data, 'guard_name', 'web');
        $this->patch('/permissions/' . $identifier, $data);

        $modelAfterUpdate = $this->getPermissionModel($identifier);
        $this->assertSame('web', $modelAfterUpdate->guard_name);
    }

    /**
     * @param array $data
     * @return void
     * @dataProvider dataProvider
     */
    public function testShouldPassIfCannotUpdateNonExistentPermission(array $data): void
    {
        $response = $this->patch('/permissions/' . 100, $data);
        $response->assertStatus(Response::HTTP_NOT_FOUND);
        $this->assertSame('Unable to find requested permission', $response->json('message'));
    }

    /**
     * @param array $data
     * @return void
     * @dataProvider dataProvider
     */
    public function testShouldPassIfCanDeleteExistingPermission(array $data): void
    {
        $identifier = $this->getCreatedPermissionID($data, true);
        $response = $this->delete('/permissions/' . $identifier);
        $response->assertStatus(Response::HTTP_OK);
        $this->assertSame('Successfully deleted permission', $response->json('message'));
    }

    /**
     * @return void
     */
    public function testShouldPassIfCannotDeleteNonExistingPermission(): void
    {
        $response = $this->delete('/permissions/4');
        $response->assertStatus(Response::HTTP_NOT_FOUND);
        $this->assertSame('Unable to find requested permission', $response->json('message'));
    }

    /**
     * @return void
     */
    public function testShouldPassIfCanGetListOfAllPermissions(): void
    {
        $response = $this->get('/permissions');
        $response->assertStatus(Response::HTTP_OK);
        $this->assertSame('Successfully fetched list of permissions', $response->json('message'));

        $data = $response->json('data');
        $this->assertCount(3, $data);

        foreach ($data as $item) {
            $this->validatePermissionStructure($item);
        }
    }

    /**
     * @return void
     */
    public function testShouldPassIfCanGetExistingPermissionInformation(): void
    {
        $response = $this->get('/permissions/1');
        $response->assertStatus(Response::HTTP_OK);
        $this->assertSame('Successfully fetched permission information', $response->json('message'));
        $this->validatePermissionStructure($response->json('data'));
    }

    /**
     * @return void
     */
    public function testShouldPassIfCannotGetNonExistingPermissionInformation(): void
    {
        $response = $this->get('/permissions/100');
        $response->assertStatus(Response::HTTP_NOT_FOUND);
        $this->assertSame('Unable to find requested permission', $response->json('message'));
    }

    /**
     * Create new permission
     * @param array $data
     * @return void
     */
    private function createPermission(array $data): void
    {
        $response = $this->post('/permissions', $data);
        $response->assertStatus(Response::HTTP_CREATED);
        $this->validateCreatedPermission($response, $data);
    }

    /**
     * Get ID for created permission
     * @param array $data
     * @param bool $create
     * @return int
     */
    private function getCreatedPermissionID(array $data, bool $create = false): int
    {
        if ($create) {
            $this->createPermission($data);
        }
        return $this->repository()->findBy('name', Arr::get($data, 'name'))->id;
    }

    /**
     * Get permission model
     * @param int $identifier
     * @return Permission
     */
    private function getPermissionModel(int $identifier): Permission
    {
        return $this->repository()->findByID($identifier);
    }

    /**
     * Validate created permission response
     * @param TestResponse|array $response
     * @param array $data
     * @return void
     */
    private function validateCreatedPermission(TestResponse|array $response, array $data): void
    {
        if ($response instanceof TestResponse) {
            $response = $response->json('data');
        }
        $this->assertArrayHasKey('id', $response);
        $this->assertArrayHasKey('created_at', $response);
        $this->assertArrayHasKey('updated_at', $response);
        $this->assertNotNull(Arr::get($response, 'created_at'));
        $this->assertNotNull(Arr::get($response, 'updated_at'));
        $this->assertSame(Arr::get($data, 'name'), Arr::get($response, 'name'));
        $this->assertSame(Arr::get($data, 'guard_name'), Arr::get($response, 'guard_name'));
    }

    /**
     * Validate permission structure
     * @param array $data
     * @return void
     */
    private function validatePermissionStructure(array $data): void
    {
        $this->assertArrayHasKey('id', $data);
        $this->assertArrayHasKey('name', $data);
        $this->assertArrayHasKey('guard_name', $data);
        $this->assertArrayHasKey('created_at', $data);
        $this->assertArrayHasKey('updated_at', $data);
    }

    /**
     * Create new repository instance
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
