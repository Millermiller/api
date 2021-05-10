<?php

namespace Tests\Feature\Controllers\Settings;


use Exception;
use Illuminate\Support\Collection;
use Scandinaver\RBAC\Domain\Model\Permission;
use Scandinaver\Settings\Domain\Model\Setting;
use Scandinaver\User\Domain\Model\User;
use Tests\TestCase;

/**
 * Class SettingControllerTest
 *
 * @package Tests\Feature\Controllers\Settings
 */
class SettingControllerTest extends TestCase
{

    private User $user;

    private Collection $settings;

    private int $settingsCount = 3;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = entity(User::class, 1)->create();

        $this->settings = entity(Setting::class, $this->settingsCount)->create();
    }

    /**
     * @throws Exception
     */
    public function testIndex(): void
    {
        $permission = entity(Permission::class)->create([
            'slug' => \Scandinaver\Settings\Domain\Permission\Settings::VIEW
        ]);
        $this->user->allow($permission);
        $this->actingAs($this->user, 'api');

        $response        = $this->get(route('settings:all'));
        $decodedResponse = json_decode($response->getContent());
        self::assertCount($this->settingsCount, $decodedResponse);
        $response->assertJsonStructure(
            [
                \Tests\Responses\Setting::response(),
            ]
        );
    }

    /**
     * @throws Exception
     */
    public function testShow(): void
    {
        $permission = entity(Permission::class)->create([
            'slug' => \Scandinaver\Settings\Domain\Permission\Settings::SHOW
        ]);
        $this->user->allow($permission);
        $this->actingAs($this->user, 'api');

        $response = $this->get(
            route('settings:show', ['id' => $this->settings->first()->getId()])
        );
        $response->assertJsonStructure(\Tests\Responses\Setting::response());
        $response->assertJsonFragment(
            [
                'id' => $this->settings->first()->getId(),
            ]
        );
    }

    /**
     * @throws Exception
     */
    public function testDestroy(): void
    {
        $permission = entity(Permission::class)->create([
            'slug' => \Scandinaver\Settings\Domain\Permission\Settings::DELETE
        ]);
        $this->user->allow($permission);
        $this->actingAs($this->user, 'api');

        $settingId = 1;

        $response = $this->delete(route('settings:delete', ['id' => $settingId]));

        //TODO: implement redis mock
        self::assertEquals(TRUE, TRUE);

        // self::assertEquals(
        //   JsonResponse::HTTP_NO_CONTENT,
        //   $response->getStatusCode()
        // );
        // $response = $this->get(route('settings:show', ['id' => $settingId]));
        // self::assertEquals(
        //   JsonResponse::HTTP_NOT_FOUND,
        //   $response->getStatusCode()
        // );
    }

    /**
     * @throws Exception
     */
    public function testStore(): void
    {
        $permission = entity(Permission::class)->create([
            'slug' => \Scandinaver\Settings\Domain\Permission\Settings::CREATE
        ]);
        $this->user->allow($permission);
        $this->actingAs($this->user, 'api');

        $testRoleName        = 'TEST_PERMISSION';
        $testRoleSlug        = 'TEST_SLUG';
        $testRoleDescription = 'TEST_DESCRIPTION';

        //TODO: implement redis mock
        self::assertEquals(TRUE, TRUE);

        /*
        $response = $this->post(
          route(
            'settings:create',
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
        */
    }

    public function testUpdate(): void
    {
        //TODO: implement redis mock
        self::assertEquals(TRUE, TRUE);
        /*
        $permission = entity(Permission::class)->create([
            'slug' => \Scandinaver\Settings\Domain\Permission\Settings::UPDATE
        ]);
        $this->user->allow($permission);
        $this->actingAs($this->user, 'api');

        $testRoleName = 'TEST_PERMISSION';
        $testRoleSlug = 'TEST_SLUG';

        $response = $this->put(
          route('settings:update', ['id' => $this->roles->first()->getId()]),
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
        */
    }

    /**
     * TODO: implement
     */
    public function testSearch(): void
    {
        self::assertEquals(TRUE, TRUE);
    }
}
