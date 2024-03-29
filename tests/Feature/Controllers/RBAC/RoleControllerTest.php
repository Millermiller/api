<?php

namespace Tests\Feature\Controllers\RBAC;


use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Scandinaver\RBAC\Domain\Entity\Permission;
use Scandinaver\RBAC\Domain\Entity\Role;
use Scandinaver\User\Domain\Entity\User;
use Tests\TestCase;

/**
 * Class RoleControllerTest
 *
 * @package Tests\Feature\Controllers\RBAC
 */
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

    /**
     * @throws Exception
     */
    public function testIndex(): void
    {
        $permission = entity(Permission::class)->create([
            'slug' => \Scandinaver\RBAC\Domain\Permission\Role::VIEW,
        ]);
        $this->user->allow($permission);
        $this->actingAs($this->user, 'api');

        $response        = $this->get(route('role:all'));
        $decodedResponse = json_decode($response->getContent(), TRUE);

        self::assertCount($this->rolesCount, $decodedResponse['data']);

        $response->assertJsonStructure(
            \Tests\Responses\Role::collectionResponse(),
        );
    }

    /**
     * @throws Exception
     */
    public function testShow(): void
    {
        $permission = entity(Permission::class)->create([
            'slug' => \Scandinaver\RBAC\Domain\Permission\Role::SHOW,
        ]);
        $this->user->allow($permission);
        $this->actingAs($this->user, 'api');

        $response = $this->get(
            route('role:show', ['id' => $this->roles->first()->getId()])
        );

        $response->assertJsonStructure(\Tests\Responses\Role::singleResponse())
                 ->assertJsonFragment(
                     [
                         'id' => (string)$this->roles->first()->getId(),
                     ]
                 );
    }

    /**
     * @throws Exception
     */
    public function testDestroy(): void
    {
        $permission = entity(Permission::class)->create([
            'slug' => \Scandinaver\RBAC\Domain\Permission\Role::DELETE,
        ]);
        $this->user->allow($permission);
        $permission = entity(Permission::class)->create([
            'slug' => \Scandinaver\RBAC\Domain\Permission\Role::SHOW,
        ]);
        $this->user->allow($permission);
        $this->actingAs($this->user, 'api');

        $roleId = 1;

        $this->delete(route('role:delete', ['id' => $roleId]))->assertStatus(JsonResponse::HTTP_NO_CONTENT);

        $this->get(route('role:show', ['id' => $roleId]))->assertStatus(JsonResponse::HTTP_NOT_FOUND);
    }

    /**
     * @throws Exception
     */
    public function testStore(): void
    {
        $permission = entity(Permission::class)->create([
            'slug' => \Scandinaver\RBAC\Domain\Permission\Role::CREATE,
        ]);
        $this->user->allow($permission);
        $this->actingAs($this->user, 'api');

        $testRoleName        = 'TEST_PERMISSION';
        $testRoleSlug        = 'TEST_SLUG';
        $testRoleDescription = 'TEST_DESCRIPTION';

        $response = $this->post(
            route(
                'role:create',
                [
                    'name'        => $testRoleName,
                    'slug'        => $testRoleSlug,
                    'description' => $testRoleDescription,
                ]
            )
        );

        $response->assertStatus(JsonResponse::HTTP_CREATED)
                 ->assertJsonStructure(\Tests\Responses\Role::singleResponse())
                 ->assertJsonFragment(
                     [
                         'name'        => $testRoleName,
                         'slug'        => $testRoleSlug,
                         'description' => $testRoleDescription,
                     ]
                 )
                 ->assertJsonPath('data.attributes.name', $testRoleName)
                 ->assertJsonPath('data.attributes.slug', $testRoleSlug)
                 ->assertJsonPath('data.attributes.description', $testRoleDescription);
    }

    /**
     * @throws Exception
     */
    public function testUpdate(): void
    {
        $permission = entity(Permission::class)->create([
            'slug' => \Scandinaver\RBAC\Domain\Permission\Role::UPDATE,
        ]);
        $this->user->allow($permission);
        $this->actingAs($this->user, 'api');

        $testRoleName = 'TEST_PERMISSION';
        $testRoleSlug = 'TEST_SLUG';

        $response = $this->put(
            route('role:update', ['id' => $this->roles->first()->getId()]),
            [
                'name'        => $testRoleName,
                'slug'        => $testRoleSlug,
                'description' => '',
            ]
        );

        $response->assertStatus(JsonResponse::HTTP_OK)
                 ->assertJsonStructure(\Tests\Responses\Role::singleResponse())
                 ->assertJsonFragment(
                     [
                         'name' => $testRoleName,
                         'slug' => $testRoleSlug,
                     ]
                 )
                 ->assertJsonPath('data.attributes.name', $testRoleName)
                 ->assertJsonPath('data.attributes.slug', $testRoleSlug);
    }

    /**
     * @throws Exception
     */
    public function testAttachPermission(): void
    {
        $permission = entity(Permission::class)->create([
            'slug' => \Scandinaver\RBAC\Domain\Permission\Role::UPDATE,
        ]);
        $this->user->allow($permission);
        $this->actingAs($this->user, 'api');

        /** @var Permission $testPermission */
        $testPermission = entity(Permission::class, 1)->create();

        $this->post(route('role:attachPermission',
            [
                'roleId'       => $this->roles->first()->getId(),
                'permissionId' => $testPermission->getId(),
            ]
        ))
             ->assertStatus(JsonResponse::HTTP_OK);
    }

    /**
     * @throws Exception
     */
    public function testDetachPermission(): void
    {
        $permission = entity(Permission::class)->create([
            'slug' => \Scandinaver\RBAC\Domain\Permission\Role::UPDATE,
        ]);
        $this->user->allow($permission);
        $this->actingAs($this->user, 'api');

        /** @var Role $role */
        $role = $this->roles->first();

        /** @var Permission $testPermission */
        $testPermission = entity(Permission::class, 1)->create();

        $role->attachPermission($testPermission);

        $this->delete(route('role:attachPermission',
            [
                'roleId'       => $role->getId(),
                'permissionId' => $testPermission->getId(),
            ]
        ))->assertStatus(JsonResponse::HTTP_OK);
    }

    /**
     * TODO: implement
     */
    public function testSearch()
    {
        self::assertEquals(TRUE, TRUE);
    }
}
