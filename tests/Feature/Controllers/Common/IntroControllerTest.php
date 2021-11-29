<?php

namespace Tests\Feature\Controllers\Common;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Scandinaver\Common\Domain\Entity\Intro;
use Scandinaver\RBAC\Domain\Entity\Permission;
use Scandinaver\User\Domain\Entity\User;
use Tests\TestCase;

/**
 * Class IntroControllerTest
 *
 * @package Tests\Feature\Controllers\Common
 */
class IntroControllerTest extends TestCase
{

    private User $user;

    private int $introNumber = 3;

    private Collection $intro;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = entity(User::class, 1)->create();

        $this->intro = entity(Intro::class, $this->introNumber)->create();
    }

    /**
     * @throws Exception
     */
    public function testIndex(): void
    {
        $permission = entity(Permission::class, 1)->create([
            'slug' => \Scandinaver\Common\Domain\Permission\Intro::VIEW,
        ]);
        $this->user->allow($permission);
        $this->actingAs($this->user, 'api');

        $response        = $this->get(route('intro:all'));
        $decodedResponse = json_decode($response->getContent(), TRUE);

        self::assertCount($this->introNumber, $decodedResponse['data']);

        $response->assertJsonStructure(
                \Tests\Responses\IntroCollection::response(),
        );
    }

    /**
     * @throws Exception
     */
    public function testStore(): void
    {
        $permission = entity(Permission::class, 1)->create([
            'slug' => \Scandinaver\Common\Domain\Permission\Intro::CREATE,
        ]);
        $this->user->allow($permission);
        $this->actingAs($this->user, 'api');

        $testIntroPage         = 'TESTPAGE';
        $testIntroContent      = 'TESTCONTENT';
        $testIntroPosition     = 'top';
        $testIntroTarget       = '#top';
        $testIntroSort         = 5;
        $testIntroTooltipClass = 'tooltipClass';

        $response = $this->post(
            route('intro:create'),
            [
                'page'         => $testIntroPage,
                'target'       => $testIntroTarget,
                'position'     => $testIntroPosition,
                'content'      => $testIntroContent,
                'sort'         => $testIntroSort,
                'headerText'   => $testIntroTooltipClass,
                'active'       => 1,
            ]
        );

        self::assertEquals(JsonResponse::HTTP_CREATED, $response->getStatusCode());

        $response->assertJsonStructure(
            \Tests\Responses\Intro::response()
        );

        $response->assertJsonFragment(
            [
                'page'         => $testIntroPage,
                'target'       => $testIntroTarget,
                'position'     => $testIntroPosition,
                'content'      => $testIntroContent,
                'sort'         => $testIntroSort,
                'headerText'   => $testIntroTooltipClass,
            ]
        );
    }

    /**
     * @throws Exception
     */
    public function testShow(): void
    {
        $permission = entity(Permission::class, 1)->create([
            'slug' => \Scandinaver\Common\Domain\Permission\Intro::SHOW,
        ]);
        $this->user->allow($permission);
        $this->actingAs($this->user, 'api');

        $testIntroId = 1;
        $response    = $this->get(route('intro:show', ['id' => $testIntroId]));

        $response->assertJsonStructure(
            \Tests\Responses\Intro::response()
        );

        $response->assertJsonFragment(
            [
                'id' => (string)$testIntroId,
            ]
        );
    }

    /**
     * @throws Exception
     */
    public function testUpdate(): void
    {
        $permission = entity(Permission::class, 1)->create([
            'slug' => \Scandinaver\Common\Domain\Permission\Intro::UPDATE,
        ]);
        $this->user->allow($permission);
        $this->actingAs($this->user, 'api');

        $testIntroPage         = 'TESTPAGE';
        $testIntroContent      = 'TESTCONTENT';
        $testIntroPosition     = 'top';
        $testIntroTarget       = '#top';
        $testIntroSort         = 5;
        $testIntroTooltipClass = 'tooltipClass';

        $response = $this->put(
            route('intro:update', ['id' => $this->intro->first()->getId()]),
            [
                'page'         => $testIntroPage,
                'target'       => $testIntroTarget,
                'position'     => $testIntroPosition,
                'content'      => $testIntroContent,
                'sort'         => $testIntroSort,
                'headerText'   => $testIntroTooltipClass,
                'active'       => 1,
            ]
        );

        self::assertEquals(JsonResponse::HTTP_OK, $response->getStatusCode());

        $response->assertJsonStructure(
            \Tests\Responses\Intro::response()
        );

        $response->assertJsonFragment(
            [
                'page'         => $testIntroPage,
                'target'       => $testIntroTarget,
                'position'     => $testIntroPosition,
                'content'      => $testIntroContent,
                'sort'         => $testIntroSort,
                'headerText'   => $testIntroTooltipClass,
            ]
        );
    }

    /**
     * @throws Exception
     */
    public function testDestroy(): void
    {
        $permission = entity(Permission::class, 1)->create([
            'slug' => \Scandinaver\Common\Domain\Permission\Intro::DELETE,
        ]);
        $this->user->allow($permission);
        $this->actingAs($this->user, 'api');

        $testIntroId = 1;

        $response = $this->delete(route('intro:delete', ['id' => $testIntroId]));

        self::assertEquals(JsonResponse::HTTP_NO_CONTENT, $response->getStatusCode());
    }

}
