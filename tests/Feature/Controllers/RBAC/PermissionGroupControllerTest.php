<?php

namespace Tests\Feature\Controllers\RBAC;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Scandinaver\RBAC\Domain\Entity\Permission;
use Scandinaver\RBAC\Domain\Entity\PermissionGroup;
use Scandinaver\User\Domain\Entity\User;
use Tests\TestCase;

/**
 * Class PermissionGroupControllerTest
 *
 * @package Tests\Feature\Controllers\RBAC
 */
class PermissionGroupControllerTest extends TestCase
{

    private User $user;

    private Collection $permissionGroups;

    private int $permissionGroupsCount = 3;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = entity(User::class, 1)->create();

        $this->permissionGroups = entity(PermissionGroup::class, $this->permissionGroupsCount)->create();
    }

    /**
     * @throws Exception
     */
    public function testIndex(): void
    {
        $permission = entity(Permission::class)->create([
            'slug' => \Scandinaver\RBAC\Domain\Permission\PermissionGroup::VIEW,
        ]);
        $this->user->allow($permission);
        $this->actingAs($this->user, 'api');

        $response        = $this->get(route('permission:group:all'));
        $decodedResponse = json_decode($response->getContent(), TRUE);

        self::assertCount($this->permissionGroupsCount + 1, $decodedResponse['data']);

        $response->assertJsonStructure(
            \Tests\Responses\PermissionGroup::collectionResponse(),
        );
    }

    /**
     * @throws Exception
     */
    public function testShow(): void
    {
        $permission = entity(Permission::class)->create([
            'slug' => \Scandinaver\RBAC\Domain\Permission\PermissionGroup::SHOW,
        ]);
        $this->user->allow($permission);
        $this->actingAs($this->user, 'api');

        $response = $this->get(route('permission:group:show', ['id' => $this->permissionGroups->first()->getId()]));

        $response->assertJsonStructure(\Tests\Responses\PermissionGroup::singleResponse())
                 ->assertJsonFragment(
                     [
                         'id' => (string)$this->permissionGroups->first()->getId(),
                     ]
                 );
    }

    /**
     * @throws Exception
     */
    public function testStore(): void
    {
        $permission = entity(Permission::class)->create([
            'slug' => \Scandinaver\RBAC\Domain\Permission\PermissionGroup::CREATE,
        ]);
        $this->user->allow($permission);
        $this->actingAs($this->user, 'api');

        $testPermissionGroupName        = 'TEST_PERMISSION';
        $testPermissionGroupSlug        = 'TEST_SLUG';
        $testPermissionGroupDescription = 'TEST_DESCRIPTION';

        $response = $this->post(route('permission:group:create',
            [
                'name'        => $testPermissionGroupName,
                'slug'        => $testPermissionGroupSlug,
                'description' => $testPermissionGroupDescription,
            ]));

        $response->assertStatus(JsonResponse::HTTP_CREATED)
                 ->assertJsonStructure(\Tests\Responses\PermissionGroup::singleResponse())
                 ->assertJsonFragment(
                     [
                         'name'        => $testPermissionGroupName,
                         'slug'        => $testPermissionGroupSlug,
                         'description' => $testPermissionGroupDescription,
                     ]
                 )
                 ->assertJsonPath('data.attributes.name', $testPermissionGroupName)
                 ->assertJsonPath('data.attributes.slug', $testPermissionGroupSlug)
                 ->assertJsonPath('data.attributes.description', $testPermissionGroupDescription);
    }

    /**
     * @throws Exception
     */
    public function testUpdate(): void
    {
        $permission = entity(Permission::class)->create([
            'slug' => \Scandinaver\RBAC\Domain\Permission\PermissionGroup::UPDATE,
        ]);
        $this->user->allow($permission);
        $this->actingAs($this->user, 'api');

        $testPermissionGroupName = 'TEST_PERMISSION';
        $testPermissionGroupSlug = 'TEST_SLUG';

        $response = $this->put(
            route('permission:group:update', ['id' => $this->permissionGroups->first()->getId()]),
            [
                'name'        => $testPermissionGroupName,
                'slug'        => $testPermissionGroupSlug,
                'description' => '',
            ]
        );

        $response->assertStatus(JsonResponse::HTTP_OK)
                 ->assertJsonStructure(\Tests\Responses\PermissionGroup::singleResponse())
                 ->assertJsonFragment(
                     [
                         'name' => $testPermissionGroupName,
                         'slug' => $testPermissionGroupSlug,
                     ]
                 )
                 ->assertJsonPath('data.attributes.name', $testPermissionGroupName)
                 ->assertJsonPath('data.attributes.slug', $testPermissionGroupSlug);
    }

    /**
     * @throws Exception
     */
    public function testDestroy(): void
    {
        $permission = entity(Permission::class)->create([
            'slug' => \Scandinaver\RBAC\Domain\Permission\PermissionGroup::DELETE,
        ]);
        $this->user->allow($permission);
        $this->actingAs($this->user, 'api');

        $response = $this->delete(route('permission:group:delete',
            [
                'id' => $this->permissionGroups->first()->getId(),
            ]
        ));

        $response->assertStatus(JsonResponse::HTTP_NO_CONTENT);
    }

    /**
     * TODO: implement
     */
    public function testSearch()
    {
        self::assertEquals(TRUE, TRUE);
    }
}
