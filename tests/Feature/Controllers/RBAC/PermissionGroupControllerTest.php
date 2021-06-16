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
            'slug' => \Scandinaver\RBAC\Domain\Permission\PermissionGroup::VIEW
        ]);
        $this->user->allow($permission);
        $this->actingAs($this->user, 'api');

        $response        = $this->get(route('permission:group:all'));
        $decodedResponse = json_decode($response->getContent());
        self::assertCount($this->permissionGroupsCount + 1, $decodedResponse);
        $response->assertJsonStructure(
            [
                \Tests\Responses\PermissionGroup::response(),
            ]
        );
    }

    /**
     * @throws Exception
     */
    public function testShow(): void
    {
        $permission = entity(Permission::class)->create([
            'slug' => \Scandinaver\RBAC\Domain\Permission\PermissionGroup::SHOW
        ]);
        $this->user->allow($permission);
        $this->actingAs($this->user, 'api');

        $response = $this->get(route('permission:group:show', ['id' => $this->permissionGroups->first()->getId()]));
        $response->assertJsonStructure(\Tests\Responses\PermissionGroup::response());
        $response->assertJsonFragment(
            [
                'id' => $this->permissionGroups->first()->getId(),
            ]
        );
    }

    /**
     * @throws Exception
     */
    public function testStore(): void
    {
        $permission = entity(Permission::class)->create([
            'slug' => \Scandinaver\RBAC\Domain\Permission\PermissionGroup::CREATE
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

        self::assertEquals(JsonResponse::HTTP_CREATED, $response->getStatusCode());

        $response->assertJsonStructure(\Tests\Responses\PermissionGroup::response());

        $response->assertJsonFragment(
            [
                'name'        => $testPermissionGroupName,
                'slug'        => $testPermissionGroupSlug,
                'description' => $testPermissionGroupDescription,
            ]
        );
    }

    /**
     * @throws Exception
     */
    public function testUpdate(): void
    {
        $permission = entity(Permission::class)->create([
            'slug' => \Scandinaver\RBAC\Domain\Permission\PermissionGroup::UPDATE
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

        self::assertEquals(JsonResponse::HTTP_OK, $response->getStatusCode());

        $response->assertJsonStructure(
            \Tests\Responses\PermissionGroup::response()
        );

        $response->assertJsonFragment(
            [
                'name' => $testPermissionGroupName,
                'slug' => $testPermissionGroupSlug,
            ]
        );
    }

    /**
     * @throws Exception
     */
    public function testDestroy(): void
    {
        $permission = entity(Permission::class)->create([
            'slug' => \Scandinaver\RBAC\Domain\Permission\PermissionGroup::DELETE
        ]);
        $this->user->allow($permission);
        $this->actingAs($this->user, 'api');

        $response = $this->delete(route('permission:group:delete',
            ['id' => $this->permissionGroups->first()->getId()]));

        self::assertEquals(JsonResponse::HTTP_NO_CONTENT, $response->getStatusCode());
    }

    /**
     * TODO: implement
     */
    public function testSearch()
    {
        self::assertEquals(TRUE, TRUE);
    }
}
