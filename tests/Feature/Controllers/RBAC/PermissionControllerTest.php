<?php

namespace Tests\Feature\Controllers\RBAC;

use Illuminate\Support\Collection;
use Illuminate\Http\JsonResponse;
use Scandinaver\RBAC\Domain\Model\Permission;
use Scandinaver\User\Domain\Model\User;
use Tests\TestCase;

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

    public function testIndex()
    {
        $this->actingAs($this->user, 'api');

        $response = $this->get(route('permission:all'));
        $decodedResponse = json_decode($response->getContent());
        self::assertCount($this->permissionCount, $decodedResponse);
        $response->assertJsonStructure(
          [
            \Tests\Responses\Permission::response(),
          ]
        );
    }

    public function testShow()
    {
        $this->actingAs($this->user, 'api');

        $response = $this->get(route('permission:show', ['id' => $this->permissions->first()->getId()]));
        $response->assertJsonStructure(\Tests\Responses\Permission::response());
        $response->assertJsonFragment(
          [
            'id' => $this->permissions->first()->getId(),
          ]
        );
    }

    public function testStore()
    {
        $this->actingAs($this->user, 'api');

        $testPermissionName = 'TEST_PERMISSION';
        $testPermissionSlug = 'TEST_SLUG';
        $testPermissionDescription = 'TEST_DESCRIPTION';

        $response = $this->post(route('permission:create', [
          'name' => $testPermissionName,
          'slug' => $testPermissionSlug,
          'description' => $testPermissionDescription,
          'group' => 1
        ]));

        self::assertEquals(JsonResponse::HTTP_CREATED, $response->getStatusCode());

        $response->assertJsonStructure(\Tests\Responses\Permission::response());

        $response->assertJsonFragment(
          [
            'name' => $testPermissionName,
            'slug' => $testPermissionSlug,
            'description' => $testPermissionDescription,
          ]
        );
    }

    public function testUpdate()
    {
        $this->actingAs($this->user, 'api');

        $testPermissionName = 'TEST_PERMISSION';
        $testPermissionSlug = 'TEST_SLUG';

        $response = $this->put(
          route('permission:update', ['id' => 1]),
          [
            'name' => $testPermissionName,
            'slug' => $testPermissionSlug,
            'description' => '',
              'group' => 1
          ]
        );

        self::assertEquals(JsonResponse::HTTP_OK, $response->getStatusCode());

        $response->assertJsonStructure(
          \Tests\Responses\Permission::response()
        );

        $response->assertJsonFragment(
          [
            'name' => $testPermissionName,
            'slug' => $testPermissionSlug,
          ]
        );
    }

    public function testDestroy()
    {
        $this->actingAs($this->user, 'api');

        $response = $this->delete(route('permission:delete', ['id' => $this->permissions->first()->getId()]));

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
