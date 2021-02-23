<?php

namespace Tests\Feature\Controllers\Common;

use App\Http\Controllers\Common\IntroController;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Scandinaver\Common\Domain\Model\Intro;
use Scandinaver\User\Domain\Model\User;
use Tests\TestCase;

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

    public function testIndex()
    {
        $this->actingAs($this->user, 'api');

        $response = $this->get(route('intro:all'));
        $decodedResponse = json_decode($response->getContent());

        self::assertCount($this->introNumber, $decodedResponse);

        $response->assertJsonStructure(
            [
                \Tests\Responses\Intro::response(),
            ]
        );
    }

    public function testStore()
    {
        $this->actingAs($this->user, 'api');

        $testIntroPage = 'TESTPAGE';
        $testIntroContent = 'TESTCONTENT';
        $testIntroPosition = 'top';
        $testIntroTarget = '#top';
        $testIntroSort = 5;
        $testIntroTooltipClass = 'tooltipClass';

        $response = $this->post(
            route('intro:create'),
            [
                'page' => $testIntroPage,
                'target' => $testIntroTarget,
                'position' => $testIntroPosition,
                'content' => $testIntroContent,
                'sort' => $testIntroSort,
                'tooltipClass' => $testIntroTooltipClass,
            ]
        );

        self::assertEquals(JsonResponse::HTTP_CREATED, $response->getStatusCode());

        $response->assertJsonStructure(
            \Tests\Responses\Intro::response()
        );

        $response->assertJsonFragment(
            [
                'page' => $testIntroPage,
                'target' => $testIntroTarget,
                'position' => $testIntroPosition,
                'content' => $testIntroContent,
                'sort' => $testIntroSort,
                'tooltipClass' => $testIntroTooltipClass,
            ]
        );
    }

    public function testShow()
    {
        $this->actingAs($this->user, 'api');

        $testIntroId = 1;
        $response = $this->get(route('intro:show', ['introId' => $testIntroId]));

        $response->assertJsonStructure(
            \Tests\Responses\Intro::response()
        );

        $response->assertJsonFragment(
            [
                'id' => $testIntroId,
            ]
        );
    }


    public function testUpdate()
    {
        $this->actingAs($this->user, 'api');

        $testIntroPage = 'TESTPAGE';
        $testIntroContent = 'TESTCONTENT';
        $testIntroPosition = 'top';
        $testIntroTarget = '#top';
        $testIntroSort = 5;
        $testIntroTooltipClass = 'tooltipClass';

        $response = $this->put(
            route('intro:update', ['introId' => $this->intro->first()->getId()]),
            [
                'page' => $testIntroPage,
                'target' => $testIntroTarget,
                'position' => $testIntroPosition,
                'content' => $testIntroContent,
                'sort' => $testIntroSort,
                'tooltipClass' => $testIntroTooltipClass,
            ]
        );

        self::assertEquals(JsonResponse::HTTP_OK, $response->getStatusCode());

        $response->assertJsonStructure(
            \Tests\Responses\Intro::response()
        );

        $response->assertJsonFragment(
            [
                'page' => $testIntroPage,
                'target' => $testIntroTarget,
                'position' => $testIntroPosition,
                'content' => $testIntroContent,
                'sort' => $testIntroSort,
                'tooltipClass' => $testIntroTooltipClass,
            ]
        );
    }

    public function testDestroy()
    {
        $this->actingAs($this->user, 'api');

        $testIntroId = 1;

        $response = $this->delete(route('intro:delete', ['introId' => $testIntroId]));

        self::assertEquals(JsonResponse::HTTP_NO_CONTENT, $response->getStatusCode());
    }

}
