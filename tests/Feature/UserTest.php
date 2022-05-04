<?php

namespace ConsulConfigManager\Users\Test\Feature;

use Illuminate\Support\Arr;
use Illuminate\Http\Response;
use ConsulConfigManager\Users\Test\TestCase;

/**
 * Class UserTest
 * @package ConsulConfigManager\Users\Test\Feature
 */
class UserTest extends TestCase
{
    /**
     * @return void
     */
    public function testShouldPassIfNoUsersReturnedFromList(): void
    {
        $response = $this->get('/users');
        $response->assertStatus(Response::HTTP_OK);
        $response->assertExactJson([
            'success'       =>  true,
            'code'          =>  Response::HTTP_OK,
            'data'          =>  [],
            'message'       =>  'Successfully fetched list of users',
        ]);
    }

    /**
     * @return void
     */
    public function testShouldPassIfCannotRetrieveInformationForNonExistentUser(): void
    {
        $response = $this->get('/users/1000');
        $response->assertStatus(Response::HTTP_NOT_FOUND);
        $response->assertExactJson([
            'success'       =>  false,
            'code'          =>  Response::HTTP_NOT_FOUND,
            'data'          =>  [],
            'message'       =>  'Unable to find requested user',
        ]);
    }

    /**
     * Test whether user can be created when valid data is provided
     * @param array $data
     * @dataProvider dataProvider
     */
    public function testShouldPassIfUserCanBeCreated(array $data): void
    {
        $response = $this->post('/users/create', $data);
        $response->assertStatus(201);
    }

    /**
     * @param array $data
     * @return void
     * @dataProvider dataProvider
     */
    public function testShouldPassIfListOfUsersReturnedFromList(array $data): void
    {
        $this->post('/users/create', $data);
        $response = $this->get('/users');
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJson([
            'success'       =>  true,
            'code'          =>  Response::HTTP_OK,
            'data'          =>  [
                [
                    'id'            => Arr::get($data, 'id'),
                    'guid'          => null,
                    'domain'        => null,
                    'first_name'    => Arr::get($data, 'first_name'),
                    'last_name'     => Arr::get($data, 'last_name'),
                    'username'      => Arr::get($data, 'username'),
                    'email'         => Arr::get($data, 'email'),
                    'role'          => Arr::get($data, 'role'),
                ],
            ],
            'message'       =>  'Successfully fetched list of users',
        ]);
    }

    /**
     * @param array $data
     * @return void
     * @dataProvider dataProvider
     */
    public function testShouldPassIfCanRetrieveInformation(array $data): void
    {
        $this->post('/users/create', $data);
        $response = $this->get('/users/1');
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJson([
            'success'       =>  true,
            'code'          =>  Response::HTTP_OK,
            'data'          =>  [
                'id'            => Arr::get($data, 'id'),
                'guid'          => null,
                'domain'        => null,
                'first_name'    => Arr::get($data, 'first_name'),
                'last_name'     => Arr::get($data, 'last_name'),
                'username'      => Arr::get($data, 'username'),
                'email'         => Arr::get($data, 'email'),
                'role'          => Arr::get($data, 'role'),
            ],
            'message'       =>  'Successfully fetched user information',
        ]);
    }

    /**
     * Test whether user creation fails if user already present in the database
     * @param array $data
     * @dataProvider dataProvider
     */
    public function testShouldPassIfUserCannotBeCreatedWithUniqueConstraint(array $data): void
    {
        $this->post('/users/create', $data); // Create new user
        $response = $this->post('/users/create', $data); // Try to create user with the same data
        $response->assertStatus(302);
    }

    /**
     * Test whether user can be updated when valid data is provided
     * @param array $data
     * @dataProvider dataProvider
     */
    public function testShouldPassIfUserCanBeUpdated(array $data): void
    {
        $this->post('/users/create', $data);
        Arr::set($data, 'id', 1);
        Arr::set($data, 'first_name', 'Jane');
        Arr::set($data, 'role', 'administrator');
        Arr::forget($data, 'password');
        $response = $this->useSanctum($data)->post('/users/update', $data);
        $response->assertStatus(200);
        $response->assertJsonFragment(Arr::except($data, [
            'guid',
            'domain',
            'password',
            'role',
        ]));
    }

    /**
     * Test whether user can be updated when valid data is provided
     * @param array $data
     * @dataProvider dataProvider
     */
    public function testShouldPassIfUserCannotBeUpdatedIfNotFound(array $data): void
    {
        $response = $this->useSanctum($data)->post('/users/update', $data);
        $response->assertStatus(404);
    }

    /**
     * Test whether user which exists in the database can be deleted
     * @param array $data
     * @dataProvider dataProvider
     */
    public function testShouldPassIfUserCanBeDeleted(array $data): void
    {
        $this->post('/users/create', $data);
        $response = $this->post('/users/delete', Arr::only($data, ['id']));
        $response->assertStatus(200);
        $response->assertJsonFragment(Arr::except($data, [
            'guid',
            'domain',
            'password',
            'role',
        ]));
    }

    /**
     * Test whether user which does not in the database will throw an error
     * @param array $data
     * @dataProvider dataProvider
     */
    public function testShouldPassIfUserCannotBeDeletedIfNotFound(array $data): void
    {
        $userID = Arr::get($data, 'id');
        $response = $this->useSanctum($data)->post('/users/delete', ['id' => $userID]);
        $response->assertStatus(404);
        $response->assertJsonFragment([
            'message'   =>  'User with ID ' . $userID . ' was not found.',
        ]);
    }

    /**
     * Data provide
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
