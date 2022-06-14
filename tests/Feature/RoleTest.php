<?php

namespace ConsulConfigManager\Users\Test\Feature;

use Illuminate\Support\Arr;
use Illuminate\Http\Response;
use Illuminate\Testing\TestResponse;
use Spatie\Permission\Contracts\Role;
use ConsulConfigManager\Users\Test\TestCase;
use ConsulConfigManager\Users\Interfaces\RoleRepositoryInterface;

/**
 * Class RoleTest
 * @package ConsulConfigManager\Users\Test\Feature
 */
class RoleTest extends TestCase
{
    /**
     * @param array $data
     * @return void
     * @dataProvider dataProvider
     */
    public function testShouldPassIfCanCreateRole(array $data): void
    {
        $response = $this->post('/roles', $data);
        $response->assertStatus(Response::HTTP_CREATED);
        $this->validateCreatedRole($response, $data);
    }

    /**
     * @param array $data
     * @return void
     * @dataProvider dataProvider
     */
    public function testShouldPassIfCannotCreateRoleWithSameName(array $data): void
    {
        $response = $this->post('/roles', $data);
        $response->assertStatus(Response::HTTP_CREATED);
        $this->validateCreatedRole($response, $data);

        $response = $this->post('/roles', $data);
        $response->assertStatus(Response::HTTP_BAD_REQUEST);
        $this->assertSame('Role with provided name already exists', $response->json('message'));
    }

    /**
     * @param array $data
     * @return void
     * @dataProvider dataProvider
     */
    public function testShouldPassIfCanUpdateExistingRole(array $data): void
    {
        $identifier = $this->getCreatedRoleID($data, true);
        $modelBeforeUpdate = $this->getRoleModel($identifier);
        $this->assertSame('api', $modelBeforeUpdate->guard_name);

        Arr::set($data, 'permissions', [1, 2]);
        $response = $this->patch('/roles/' . $identifier, $data);
        $response->assertStatus(Response::HTTP_OK);
    }

    /**
     * @param array $data
     * @return void
     * @dataProvider dataProvider
     */
    public function testShouldPassIfCannotUpdateNonExistentRole(array $data): void
    {
        $response = $this->patch('/roles/' . 100, $data);
        $response->assertStatus(Response::HTTP_NOT_FOUND);
        $this->assertSame('Unable to find requested role', $response->json('message'));
    }

    /**
     * @param array $data
     * @return void
     * @dataProvider dataProvider
     */
    public function testShouldPassIfCanDeleteExistingRole(array $data): void
    {
        $this->createUser();
        $response = $this->delete('/roles/3');
        $response->assertStatus(Response::HTTP_OK);
        $this->assertSame('Successfully deleted role', $response->json('message'));
    }

    /**
     * @return void
     */
    public function testShouldPassIfCannotDeleteNonExistingRole(): void
    {
        $response = $this->delete('/roles/100');
        $response->assertStatus(Response::HTTP_NOT_FOUND);
        $this->assertSame('Unable to find requested role', $response->json('message'));
    }

    /**
     * @return void
     */
    public function testShouldPassIfCanGetListOfAllRoles(): void
    {
        $response = $this->get('/roles');
        $response->assertStatus(Response::HTTP_OK);
        $this->assertSame('Successfully fetched list of roles', $response->json('message'));

        $data = $response->json('data');
        $this->assertCount(4, $data);

        foreach ($data as $item) {
            $this->validateRoleStructure($item);
        }
    }

    /**
     * @return void
     */
    public function testShouldPassIfCanGetExistingRoleInformation(): void
    {
        $response = $this->get('/roles/1');
        $response->assertStatus(Response::HTTP_OK);
        $this->assertSame('Successfully fetched role information', $response->json('message'));
        $this->validateRoleStructure($response->json('data'));
    }

    /**
     * @return void
     */
    public function testShouldPassIfCannotGetNonExistingRoleInformation(): void
    {
        $response = $this->get('/roles/100');
        $response->assertStatus(Response::HTTP_NOT_FOUND);
        $this->assertSame('Unable to find requested role', $response->json('message'));
    }

    /**
     * Create new role
     * @param array $data
     * @return void
     */
    private function createRole(array $data): void
    {
        $response = $this->post('/roles', $data);
        $response->assertStatus(Response::HTTP_CREATED);
        $this->validateCreatedRole($response, $data);
    }

    /**
     * Get ID for created role
     * @param array $data
     * @param bool $create
     * @return int
     */
    private function getCreatedRoleID(array $data, bool $create = false): int
    {
        if ($create) {
            $this->createRole($data);
        }
        return $this->repository()->findBy('name', Arr::get($data, 'name'))->id;
    }

    /**
     * Get role model
     * @param int $identifier
     * @return Role
     */
    private function getRoleModel(int $identifier): Role
    {
        return $this->repository()->findByID($identifier);
    }

    /**
     * Validate created role response
     * @param TestResponse|array $response
     * @param array $data
     * @return void
     */
    private function validateCreatedRole(TestResponse|array $response, array $data): void
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
     * Validate role structure
     * @param array $data
     * @return void
     */
    private function validateRoleStructure(array $data): void
    {
        $this->assertArrayHasKey('id', $data);
        $this->assertArrayHasKey('name', $data);
        $this->assertArrayHasKey('guard_name', $data);
        $this->assertArrayHasKey('created_at', $data);
        $this->assertArrayHasKey('updated_at', $data);
    }

    /**
     * Create new repository instance
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
                    'roles'           =>  [],
                ],
            ],
        ];
    }

    /**
     * Create new user
     * @return void
     */
    public function createUser(): void
    {
        $result = $this->post('/users/create', [
            'id'                =>  1,
            'guid'              =>  '60f57a6e-41f9-48b1-b429-e938715927a5',
            'domain'            =>  'example',
            'first_name'        =>  'John',
            'last_name'         =>  'Doe',
            'username'          =>  'john.doe',
            'email'             =>  'john.doe@example.com',
            'password'          =>  'Examp1ePassw0rd',
            'role'              =>  'developer',
        ]);
        $result->assertStatus(Response::HTTP_CREATED);
    }
}
