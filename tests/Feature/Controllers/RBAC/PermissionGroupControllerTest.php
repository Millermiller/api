<?php

namespace Tests\Feature\Controllers\RBAC;

use App\Http\Controllers\RBAC\PermissionGroupController;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Scandinaver\RBAC\Domain\Model\PermissionGroup;
use Scandinaver\RBAC\Domain\Model\Role;
use Scandinaver\RBAC\Domain\Services\RBACService;
use Scandinaver\User\Domain\Model\User;
use Tests\TestCase;

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
    
    public function testIndex()
    {
        $this->actingAs($this->user, 'api');

        $response = $this->get(route('permission:group:all'));
        $decodedResponse = json_decode($response->getContent());
        self::assertCount($this->permissionGroupsCount, $decodedResponse);
        $response->assertJsonStructure(
          [
            \Tests\Responses\PermissionGroup::response(),
          ]
        );
    }

    public function testShow()
    {
        $this->actingAs($this->user, 'api');

        $response = $this->get(route('permission:group:show', ['id' => $this->permissionGroups->first()->getId()]));
        $response->assertJsonStructure(\Tests\Responses\PermissionGroup::response());
        $response->assertJsonFragment(
          [
            'id' => $this->permissionGroups->first()->getId(),
          ]
        );
    }

    public function testStore()
    {
        $this->actingAs($this->user, 'api');

        $testPermissionGroupName = 'TEST_PERMISSION';
        $testPermissionGroupSlug = 'TEST_SLUG';
        $testPermissionGroupDescription = 'TEST_DESCRIPTION';

        $response = $this->post(route('permission:group:create', [
          'name' => $testPermissionGroupName,
          'slug' => $testPermissionGroupSlug,
          'description' => $testPermissionGroupDescription,
        ]));

        self::assertEquals(JsonResponse::HTTP_CREATED, $response->getStatusCode());

        $response->assertJsonStructure(\Tests\Responses\PermissionGroup::response());

        $response->assertJsonFragment(
          [
            'name' => $testPermissionGroupName,
            'slug' => $testPermissionGroupSlug,
            'description' => $testPermissionGroupDescription,
          ]
        );
    }

    public function testUpdate()
    {
        $this->actingAs($this->user, 'api');

        $testPermissionGroupName = 'TEST_PERMISSION';
        $testPermissionGroupSlug = 'TEST_SLUG';

        $response = $this->put(
          route('permission:group:update', ['id' => $this->permissionGroups->first()->getId()]),
          [
            'name' => $testPermissionGroupName,
            'slug' => $testPermissionGroupSlug,
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

    public function testDestroy()
    {
        $this->actingAs($this->user, 'api');

        $response = $this->delete(route('permission:group:delete', ['id' => $this->permissionGroups->first()->getId()]));

        self::assertEquals(JsonResponse::HTTP_NO_CONTENT, $response->getStatusCode());
    }

    /**
     * TODO: implement
     */
    public function testSearch()
    {
        self::assertEquals(true, true);
    }
}
