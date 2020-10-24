<?php

namespace Tests\Feature\Controllers\Common;

use Illuminate\Http\JsonResponse;
use Scandinaver\Common\Domain\Model\Log;
use Scandinaver\User\Domain\Model\User;
use Tests\TestCase;

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

    public function testIndex()
    {
        $this->actingAs($this->user, 'api');

        $response = $this->get(route('log.index'));
        $decodedResponse = json_decode($response->getContent());

        self::assertCount($this->logsNumber, $decodedResponse);

        $response->assertJsonStructure(
            [
                \Tests\Responses\Log::response(),
            ]
        );
    }

    public function testShow()
    {
        $this->actingAs($this->user, 'api');

        $response = $this->get(route('log.show', ['log' => 1]));

        $response->assertJsonStructure(
                \Tests\Responses\Log::response()
        );
    }

    public function testDestroy()
    {
        $this->actingAs($this->user, 'api');

        $response = $this->delete(route('log.destroy', ['log' => 1]));

        self::assertEquals(JsonResponse::HTTP_NO_CONTENT, $response->getStatusCode());
    }
}
