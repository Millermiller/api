<?php

namespace Tests\Feature\Controllers\Common;

use Scandinaver\Common\Domain\Entity\Feedback;
use Scandinaver\User\Domain\Entity\User;
use Tests\TestCase;

/**
 * Class FeedbackControllerTest
 *
 * @package Tests\Feature\Controllers\Common
 */
class FeedbackControllerTest extends TestCase
{

    private User $user;

    private int $messageNumber = 5;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = entity(User::class, 1)->create();

        entity(Feedback::class, $this->messageNumber)->create();
    }

    //public function testShow()
    //{
    //    $this->actingAs($this->user, 'api');
    //
    //    $response = $this->get(route('message.show', ['message' => 1]));
    //
    //    $response->assertJsonStructure(
    //        \Tests\Responses\Message::response()
    //    );
    //}

    //public function testIndex()
    //{
    //    $this->actingAs($this->user, 'api');
    //
    //    $response = $this->get(route('message.index'));
    //    $decodedResponse = json_decode($response->getContent());
    //
    //    self::assertCount($this->messageNumber, $decodedResponse);
    //
    //    $response->assertJsonStructure(
    //        [
    //            \Tests\Responses\Message::response(),
    //        ]
    //    );
    //}

    //public function testDestroy()
    //{
    //    $this->actingAs($this->user, 'api');
    //
    //    $response = $this->delete(route('message.destroy', ['message' => 1]));
    //
    //    self::assertEquals(JsonResponse::HTTP_NO_CONTENT, $response->getStatusCode());
    //}

    /**
     * TODO: implement
     */
    public function testRead()
    {
        self::assertEquals(TRUE, TRUE);
    }
}
