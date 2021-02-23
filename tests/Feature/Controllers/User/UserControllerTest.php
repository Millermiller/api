<?php

namespace Tests\Feature\Controllers\User;

use App\Http\Controllers\User\UserController;
use Illuminate\Http\JsonResponse;
use Scandinaver\User\Domain\Model\User;
use Tests\TestCase;

/**
 * Class UserControllerTest
 *
 * @package Tests\Feature\Controllers\User
 */
class UserControllerTest extends TestCase
{
    private int $userCount = 3;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = entity(User::class, 1)->create();

        entity(User::class, $this->userCount)->create();
    }

    public function testIndex()
    {
        $this->actingAs($this->user, 'api');

        $response = $this->get(route('user:all'));
        $decodedResponse = json_decode($response->getContent());
        self::assertCount($this->userCount + 1, $decodedResponse);
        $response->assertJsonStructure(
            [
                \Tests\Responses\User::response()
            ]
        );
    }

    public function testShow()
    {
        $this->actingAs($this->user, 'api');

        $response = $this->get(route('user:show', ['id' => 1]));

        $response->assertJsonStructure(
            \Tests\Responses\User::response()
        );
        $response->assertJsonFragment(
            [
                'id' => 1,
            ]
        );
    }

    /**
     * TODO: implement
     */
    public function testStore()
    {
        self::assertEquals(true, true);
    }

    public function testUpdate()
    {
        $this->actingAs($this->user, 'api');

        $testLogin = 'TESTLOGIN';
        $testEmail = 'TESTEMAIL@MAIL.COM';

        $response = $this->put(route('user:update', ['id' => 1]), [
            'login' => $testLogin,
            'email' => $testEmail,
            'roles' => [],
            'password' => '12345'
        ]);

        self::assertEquals(JsonResponse::HTTP_OK, $response->getStatusCode());


        $response->assertJsonStructure(
            \Tests\Responses\User::response()
        );
        $response->assertJsonFragment(
            [
                'login' => $testLogin,
                'email' => $testEmail,
            ]
        );
    }

    public function testDestroy()
    {
        $this->actingAs($this->user, 'api');

        $userId = 1;

        $response = $this->delete(route('user:delete', ['id' => $userId]));

        self::assertEquals(JsonResponse::HTTP_NO_CONTENT, $response->getStatusCode());

        $response = $this->get(route('user:show', ['id' => $userId]));

        self::assertEquals(JsonResponse::HTTP_NOT_FOUND, $response->getStatusCode());
    }

    /**
     * TODO: implement
     */
    public function testActive()
    {
        self::assertEquals(true, true);
    }

    /**
     * TODO: implement
     */
    public function testSearch()
    {
        self::assertEquals(true, true);
    }
}
