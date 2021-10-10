<?php

namespace Tests\Feature\Controllers\Learn;

use Exception;
use Mockery\MockInterface;
use Scandinaver\Common\Domain\Entity\Language;
use Scandinaver\Learn\Domain\Entity\Passing;
use Scandinaver\Learn\Domain\Entity\WordAsset;
use Scandinaver\RBAC\Domain\Entity\Permission;
use Scandinaver\Settings\Domain\Service\SettingsService;
use Scandinaver\User\Domain\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

/**
 * Class TestControllerTest
 *
 * @package Tests\Feature\Controllers\Learn
 */
class TestControllerTest extends TestCase
{

    private const LANGUAGE_LETTER = 'is';

    private User $user;

    private Passing $passing;

    protected function setUp(): void
    {
        parent::setUp();

        $language = entity(Language::class)->create(['letter' => self::LANGUAGE_LETTER]);

        $this->user = entity(User::class)->create();

        $asset = entity(WordAsset::class)->create([
            'user'     => $this->user,
            'language' => $language,
        ]);

        $this->passing = entity(Passing::class)->create([
            'user'     => $this->user,
            'asset'    => $asset,
            'language' => $language,
        ]);
        $this->user->addAssetPassing($this->passing);
    }

    /**
     * @throws Exception
     */
    public function testIndex(): void
    {
        $permission = new Permission(\Scandinaver\Learn\Domain\Permission\Test::GET_ALL_PASSINGS);
        $this->user->allow($permission);
        $this->actingAs($this->user, 'api');

        $response = $this->get(route('test:all',
            [
                'language' => self::LANGUAGE_LETTER,
            ]));

        self::assertEquals(Response::HTTP_OK, $response->getStatusCode());
        $response->assertJsonStructure(
            [\Tests\Responses\Passing::response()]
        );
    }

    /**
     * @throws Exception
     */
    public function testUpdate(): void
    {
        $permission = new Permission(\Scandinaver\Learn\Domain\Permission\Test::UPDATE_PASSING);
        $this->user->allow($permission);
        $this->actingAs($this->user, 'api');

        $response = $this->put(route('test:update',
            [
                'id' => $this->passing->getId(),
            ]),
            [
                'percent'   => 100,
                'completed' => 1,
            ]);

        self::assertEquals(Response::HTTP_OK, $response->getStatusCode());
    }

    /**
     * @throws Exception
     */
    public function testDestroy(): void
    {
        $permission = new Permission(\Scandinaver\Learn\Domain\Permission\Test::DELETE_PASSING);
        $this->user->allow($permission);
        $this->actingAs($this->user, 'api');

        $response = $this->delete(route('test:delete',
            [
                'id' => $this->passing->getId(),
            ]));

        self::assertEquals(Response::HTTP_NO_CONTENT, $response->getStatusCode());
    }

    /**
     * @throws Exception
     */
    public function testComplete(): void
    {
        $permission = new Permission(\Scandinaver\Learn\Domain\Permission\Test::COMPLETE);
        $this->user->allow($permission);
        $this->actingAs($this->user, 'api');

        $this->mock(SettingsService::class,
            function (MockInterface $mock) {
                $mock->shouldReceive('getSettingValue')
                     ->withArgs(['test_threshold'])
                     ->once()
                     ->andReturn(10);
            });

        $response = $this->post(route('test:complete',
            [
                'id' => $this->passing->getId(),
            ]),
            [
                'id'      => $this->passing->getId(),
                'time'    => 60,
                'percent' => 80,
                'errors'  => [],
                'cards'   => [],
            ]);

        self::assertEquals(Response::HTTP_CREATED, $response->getStatusCode());
    }
}
