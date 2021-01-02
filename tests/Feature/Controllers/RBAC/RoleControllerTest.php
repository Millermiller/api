<?php

namespace Tests\Feature\Controllers\RBAC;


use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Scandinaver\RBAC\Domain\Model\Permission;
use Scandinaver\RBAC\Domain\Model\Role;
use Scandinaver\User\Domain\Model\User;
use Tests\TestCase;

class RoleControllerTest extends TestCase
{

    private User $user;

    private Collection $roles;

    private int $rolesCount = 3;


    protected function setUp(): void
    {
        parent::setUp();

        $this->user = entity(User::class, 1)->create();

        $this->roles = entity(Role::class, $this->rolesCount)->create();
    }

    public function testIndex()
    {
        $this->actingAs($this->user, 'api');

        $response = $this->get(route('role:all'));
        $decodedResponse = json_decode($response->getContent());
        self::assertCount($this->rolesCount, $decodedResponse);
        $response->assertJsonStructure(
          [
            \Tests\Responses\Role::response(),
          ]
        );
    }

    public function testShow()
    {
        $this->actingAs($this->user, 'api');

        $response = $this->get(
          route('role:show', ['id' => $this->roles->first()->getId()])
        );
        $response->assertJsonStructure(\Tests\Responses\Role::response());
        $response->assertJsonFragment(
          [
            'id' => $this->roles->first()->getId(),
          ]
        );
    }

    public function testDestroy()
    {
        $this->actingAs($this->user, 'api');

        $roleId = 1;

        $response = $this->delete(route('role:delete', ['id' => $roleId]));

        self::assertEquals(
          JsonResponse::HTTP_NO_CONTENT,
          $response->getStatusCode()
        );

        $response = $this->get(route('role:show', ['id' => $roleId]));

        self::assertEquals(
          JsonResponse::HTTP_NOT_FOUND,
          $response->getStatusCode()
        );
    }

    public function testStore()
    {
        $this->actingAs($this->user, 'api');

        $testRoleName = 'TEST_PERMISSION';
        $testRoleSlug = 'TEST_SLUG';
        $testRoleDescription = 'TEST_DESCRIPTION';

        $response = $this->post(
          route(
            'role:create',
            [
              'name' => $testRoleName,
              'slug' => $testRoleSlug,
              'description' => $testRoleDescription,
            ]
          )
        );

        self::assertEquals(
          JsonResponse::HTTP_CREATED,
          $response->getStatusCode()
        );

        $response->assertJsonStructure(\Tests\Responses\Role::response());

        $response->assertJsonFragment(
          [
            'name' => $testRoleName,
            'slug' => $testRoleSlug,
            'description' => $testRoleDescription,
          ]
        );
    }

    public function testUpdate()
    {
        $this->actingAs($this->user, 'api');

        $testRoleName = 'TEST_PERMISSION';
        $testRoleSlug = 'TEST_SLUG';

        $response = $this->put(
          route('role:update', ['id' => $this->roles->first()->getId()]),
          [
            'name' => $testRoleName,
            'slug' => $testRoleSlug,
            'description' => '',
          ]
        );

        self::assertEquals(JsonResponse::HTTP_OK, $response->getStatusCode());

        $response->assertJsonStructure(\Tests\Responses\Role::response());

        $response->assertJsonFragment(
          [
            'name' => $testRoleName,
            'slug' => $testRoleSlug,
          ]
        );
    }

    public function testAttachPermission()
    {
        $this->actingAs($this->user, 'api');
        /** @var Permission $testPermission */
        $testPermission = entity(Permission::class, 1)->create();

        $response = $this->post(route('role:attachPermission',
          [
            'roleId' => $this->roles->first()->getId(),
            'permissionId' => $testPermission->getId(),
            ]
        ));

        self::assertEquals(JsonResponse::HTTP_OK, $response->getStatusCode());
    }

    /**
     * @throws Exception
     */
    public function testDetachPermission()
    {
        $this->actingAs($this->user, 'api');

        /** @var Role $role */
        $role = $this->roles->first();

        /** @var Permission $testPermission */
        $testPermission = entity(Permission::class, 1)->create();

        $role->attachPermission($testPermission);

        $response = $this->delete(route('role:attachPermission',
          [
            'roleId' => $role->getId(),
            'permissionId' => $testPermission->getId(),
          ]
        ));

        self::assertEquals(JsonResponse::HTTP_OK, $response->getStatusCode());
    }

    /**
     * TODO: implement
     */
    public function testSearch()
    {
        self::assertEquals(true, true);
    }
}