<?php

namespace Tests\Feature\Controllers\RBAC;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Scandinaver\RBAC\Domain\Entity\Permission;
use Scandinaver\User\Domain\Entity\User;
use Tests\TestCase;

/**
 * Class PermissionControllerTest
 *
 * @package Tests\Feature\Controllers\RBAC
 */
class PermissionControllerTest extends TestCase
{

    private User $user;

    private int $permissionCount = 3;

    private Collection $permissions;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = entity(User::class, 1)->create();

        $this->permissions = entity(Permission::class, $this->permissionCount)->create();
    }

    /**
     * @throws Exception
     */
    public function testIndex(): void
    {
        $permission = entity(Permission::class)->create([
            'slug' => \Scandinaver\RBAC\Domain\Permission\Permission::VIEW,
        ]);
        $this->user->allow($permission);
        $this->actingAs($this->user, 'api');

        $response        = $this->getJson(route('permission:all'));
        $decodedResponse = json_decode($response->getContent(), TRUE);

        self::assertCount($this->permissionCount + 1, $decodedResponse['data']);

        $response->assertJsonStructure(
            \Tests\Responses\Permission::collectionResponse(),
        );
    }

    /**
     * @throws Exception
     */
    public function testShow(): void
    {
        $permission = entity(Permission::class)->create([
            'slug' => \Scandinaver\RBAC\Domain\Permission\Permission::SHOW,
        ]);
        $this->user->allow($permission);
        $this->actingAs($this->user, 'api');

        $response = $this->get(route('permission:show', ['id' => $this->permissions->first()->getId()]));

        $response->assertJsonStructure(\Tests\Responses\Permission::singleResponse())
                 ->assertJsonFragment(
                     [
                         'id' => (string)$this->permissions->first()->getId(),
                     ]
                 );
    }

    /**
     * @throws Exception
     */
    public function testStore(): void
    {
        $permission = entity(Permission::class)->create([
            'slug' => \Scandinaver\RBAC\Domain\Permission\Permission::CREATE,
        ]);
        $this->user->allow($permission);
        $this->actingAs($this->user, 'api');

        $testPermissionName        = 'TEST_PERMISSION';
        $testPermissionSlug        = 'TEST_SLUG';
        $testPermissionDescription = 'TEST_DESCRIPTION';

        $response = $this->post(route('permission:create',
            [
                'name'        => $testPermissionName,
                'slug'        => $testPermissionSlug,
                'description' => $testPermissionDescription,
                'group'       => 1,
            ]));

        $response->assertStatus(JsonResponse::HTTP_CREATED)
                 ->assertJsonStructure(\Tests\Responses\Permission::singleResponse())
                 ->assertJsonFragment(
                     [
                         'name'        => $testPermissionName,
                         'slug'        => $testPermissionSlug,
                         'description' => $testPermissionDescription,
                     ]
                 )
                 ->assertJsonPath('data.attributes.name', $testPermissionName)
                 ->assertJsonPath('data.attributes.slug', $testPermissionSlug)
                 ->assertJsonPath('data.attributes.description', $testPermissionDescription);
    }

    /**
     * @throws Exception
     */
    public function testUpdate(): void
    {
        $permission = entity(Permission::class)->create([
            'slug' => \Scandinaver\RBAC\Domain\Permission\Permission::UPDATE,
        ]);
        $this->user->allow($permission);
        $this->actingAs($this->user, 'api');

        $testPermissionName = 'TEST_PERMISSION';
        $testPermissionSlug = 'TEST_SLUG';

        $response = $this->put(
            route('permission:update', ['id' => 1]),
            [
                'name'        => $testPermissionName,
                'slug'        => $testPermissionSlug,
                'description' => '',
                'group'       => 1,
            ]
        );


        $response->assertStatus(JsonResponse::HTTP_OK)
                 ->assertJsonStructure(\Tests\Responses\Permission::singleResponse())
                 ->assertJsonFragment(
                     [
                         'name' => $testPermissionName,
                         'slug' => $testPermissionSlug,
                     ]
                 )
                 ->assertJsonPath('data.attributes.name', $testPermissionName)
                 ->assertJsonPath('data.attributes.slug', $testPermissionSlug);
    }

    /**
     * @throws Exception
     */
    public function testDestroy(): void
    {
        $permission = entity(Permission::class)->create([
            'slug' => \Scandinaver\RBAC\Domain\Permission\Permission::DELETE,
        ]);
        $this->user->allow($permission);
        $this->actingAs($this->user, 'api');

        $response = $this->delete(route('permission:delete', ['id' => $this->permissions->first()->getId()]));

        $response->assertStatus(JsonResponse::HTTP_NO_CONTENT);
    }

    /**
     * TODO: implement
     */
    public function testSearch(): void
    {
        self::assertEquals(TRUE, TRUE);
    }

}
