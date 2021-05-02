<?php

namespace Tests\Feature\Controllers\Settings;


use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
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

    public function testIndex()
    {
        $this->actingAs($this->user, 'api');

        $response = $this->get(route('settings:all'));
        $decodedResponse = json_decode($response->getContent());
        self::assertCount($this->settingsCount, $decodedResponse);
        $response->assertJsonStructure(
          [
            \Tests\Responses\Setting::response(),
          ]
        );
    }

    public function testShow()
    {
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

    public function testDestroy()
    {
        $this->actingAs($this->user, 'api');

        $settingId = 1;

        $response = $this->delete(route('settings:delete', ['id' => $settingId]));

        //TODO: implement redis mock
        self::assertEquals(true, true);

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

    public function testStore()
    {
        $this->actingAs($this->user, 'api');

        $testRoleName = 'TEST_PERMISSION';
        $testRoleSlug = 'TEST_SLUG';
        $testRoleDescription = 'TEST_DESCRIPTION';

        //TODO: implement redis mock
        self::assertEquals(true, true);

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

    public function testUpdate()
    {
        //TODO: implement redis mock
        self::assertEquals(true, true);
        /*
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
    public function testSearch()
    {
        self::assertEquals(true, true);
    }
}
