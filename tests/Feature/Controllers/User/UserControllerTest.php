<?php

namespace Tests\Feature\Controllers\User;

use Exception;
use Illuminate\Http\JsonResponse;
use Scandinaver\RBAC\Domain\Entity\Permission;
use Scandinaver\User\Domain\Entity\User;
use Symfony\Component\HttpFoundation\Response;
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

    /**
     * @throws Exception
     */
    public function testIndex(): void
    {
        $permission = entity(Permission::class)->create([
            'slug' => \Scandinaver\User\Domain\Permission\User::VIEW
        ]);
        $this->user->allow($permission);
        $this->actingAs($this->user, 'api');

        $response        = $this->get(route('user:all', [
            'includes' => ['roles']
        ]));
        $decodedResponse = json_decode($response->getContent(), TRUE);

        self::assertCount($this->userCount + 1, $decodedResponse['data']);

        $response->assertJsonStructure(
            \Tests\Responses\User::collectionResponse(),
        );
    }

    /**
     * @throws Exception
     */
    public function testShow(): void
    {
        $permission = entity(Permission::class)->create([
            'slug' => \Scandinaver\User\Domain\Permission\User::SHOW
        ]);
        $this->user->allow($permission);
        $this->actingAs($this->user, 'api');

        $response = $this->get(route('user:show', ['id' => 1]));

        $response->assertJsonStructure(
            \Tests\Responses\User::singleResponse()
        );
        $response->assertJsonFragment(
            [
                'id' => "1",
            ]
        );
    }

    /**
     * TODO: implement
     */
    public function testStore(): void
    {
        self::assertEquals(TRUE, TRUE);
    }

    /**
     * @throws Exception
     */
    public function testUpdate(): void
    {
        $permission = entity(Permission::class)->create([
            'slug' => \Scandinaver\User\Domain\Permission\User::UPDATE
        ]);
        $this->user->allow($permission);
        $this->actingAs($this->user, 'api');

        $testLogin = 'TESTLOGIN';
        $testEmail = 'TESTEMAIL@MAIL.COM';

        $response = $this->put(route('user:update', ['id' => 1]),
            [
                'login'    => $testLogin,
                'email'    => $testEmail,
                'roles'    => [],
                'password' => '12345',
            ]);

        self::assertEquals(JsonResponse::HTTP_OK, $response->getStatusCode());


        $response->assertJsonStructure(
            \Tests\Responses\User::singleResponse()
        );
        $response->assertJsonFragment(
            [
                'login' => $testLogin,
                'email' => $testEmail,
            ]
        );
    }

    /**
     * @throws Exception
     */
    public function testDestroy(): void
    {
        $permission = entity(Permission::class)->create([
            'slug' => \Scandinaver\User\Domain\Permission\User::DELETE
        ]);
        $this->user->allow($permission);
        $permission = entity(Permission::class)->create([
            'slug' => \Scandinaver\User\Domain\Permission\User::SHOW
        ]);
        $this->user->allow($permission);
        $this->actingAs($this->user, 'api');

        $userId = 1;

        $response = $this->delete(route('user:delete', ['id' => $userId]));

        self::assertEquals(Response::HTTP_NO_CONTENT, $response->getStatusCode());

        $response = $this->get(route('user:show', ['id' => $userId]));

        self::assertEquals(Response::HTTP_NOT_FOUND, $response->getStatusCode());
    }

    /**
     * TODO: implement
     */
    public function testActive(): void
    {
        self::assertEquals(TRUE, TRUE);
    }

    /**
     * TODO: implement
     */
    public function testSearch(): void
    {
        self::assertEquals(TRUE, TRUE);
    }
}
