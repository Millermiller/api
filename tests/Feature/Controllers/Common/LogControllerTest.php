<?php

namespace Tests\Feature\Controllers\Common;

use Exception;
use Illuminate\Http\JsonResponse;
use Scandinaver\Common\Domain\Entity\Log;
use Scandinaver\RBAC\Domain\Entity\Permission;
use Scandinaver\User\Domain\Entity\User;
use Tests\TestCase;

/**
 * Class LogControllerTest
 *
 * @package Tests\Feature\Controllers\Common
 */
class LogControllerTest extends TestCase
{

    private User $user;

    private int $logsNumber = 5;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = entity(User::class, 1)->create();

        entity(Log::class, $this->logsNumber)->create(['user' => $this->user]);
    }

    /**
     * @throws Exception
     */
    public function testIndex(): void
    {
        $permission = entity(Permission::class)->create([
            'slug' => \Scandinaver\Common\Domain\Permission\Log::VIEW
        ]);
        $this->user->allow($permission);
        $this->actingAs($this->user, 'api');

        $response        = $this->get(route('log.index'));
        $decodedResponse = json_decode($response->getContent(), TRUE);

        self::assertCount($this->logsNumber, $decodedResponse['data']);

        $response->assertJsonStructure(
            \Tests\Responses\LogCollection::response(),
        );
    }

    /**
     * @throws Exception
     */
    public function testShow(): void
    {
        $permission = entity(Permission::class)->create([
            'slug' => \Scandinaver\Common\Domain\Permission\Log::SHOW
        ]);
        $this->user->allow($permission);
        $this->actingAs($this->user, 'api');

        $response = $this->get(route('log.show', ['log' => 1]));

        $response->assertJsonStructure(
            \Tests\Responses\Log::response()
        );
    }

    /**
     * @throws Exception
     */
    public function testDestroy(): void
    {
        $permission = entity(Permission::class)->create([
            'slug' => \Scandinaver\Common\Domain\Permission\Log::DELETE
        ]);
        $this->user->allow($permission);
        $this->actingAs($this->user, 'api');

        $response = $this->delete(route('log.destroy', ['log' => 1]));

        self::assertEquals(JsonResponse::HTTP_NO_CONTENT, $response->getStatusCode());
    }
}
