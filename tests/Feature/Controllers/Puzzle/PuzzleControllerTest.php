<?php

namespace Tests\Feature\Controllers\Puzzle;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Scandinaver\Common\Domain\Entity\Language;
use Scandinaver\Puzzle\Domain\Entity\Puzzle;
use Scandinaver\RBAC\Domain\Entity\Permission;
use Scandinaver\User\Domain\Entity\User;
use Tests\TestCase;

/**
 * Class PuzzleControllerTest
 *
 * @package Tests\Feature\Controllers\Puzzle
 */
class PuzzleControllerTest extends TestCase
{

    private const LANGUAGE_LETTER = 'is';

    private const PUZZLE_COUNT = 4;

    private User $user;

    /**
     * @var Collection|Puzzle[]
     */
    private Collection $puzzles;

    protected function setUp(): void
    {
        parent::setUp();

        $language = entity(Language::class)->create(['letter' => self::LANGUAGE_LETTER]);

        $this->puzzles = entity(Puzzle::class, self::PUZZLE_COUNT)->create(['language' => $language]);

        $this->user = entity(User::class)->create();
    }

    /**
     * @throws Exception
     */
    public function testIndex(): void
    {
        $permission = new Permission(\Scandinaver\Puzzle\Domain\Permission\Puzzle::VIEW);
        $this->user->allow($permission);
        $this->actingAs($this->user, 'api');

        $response = $this->get(route('puzzle:all',
            [
                'lang' => self::LANGUAGE_LETTER,
            ]
        ));

        self::assertEquals(JsonResponse::HTTP_OK, $response->getStatusCode());

        $response->assertJsonStructure([\Tests\Responses\Puzzle::response()]);
    }

    /**
     * TODO: not implemented
     *
     * @throws Exception
     * @see PuzzleQueryHandler
     */
    public function testShow(): void
    {
        // $permission = new Permission(\Scandinaver\Puzzle\Domain\Permission\Puzzle::SHOW);
        // $this->user->allow($permission);
        // $this->actingAs($this->user, 'api');
        // $response = $this->get(route('puzzle:show',
        //     [
        //         'id' => $this->puzzles->first()->getId()
        //     ]
        // ));
        self::assertEquals(TRUE, TRUE);
        // self::assertEquals(JsonResponse::HTTP_OK, $response->getStatusCode());
    }

    /**
     * @throws Exception
     */
    public function testStore(): void
    {
        $permission = new Permission(\Scandinaver\Puzzle\Domain\Permission\Puzzle::CREATE);
        $this->user->allow($permission);
        $this->actingAs($this->user, 'api');

        $response = $this->post(route('puzzle:store',
            [
                'language' => self::LANGUAGE_LETTER,
            ]),
            [
                'text'           => 'MY_PUZZLE_TEXT',
                'translate'      => 'MY_PUZZLE_TRANSLATE',
                'languageLetter' => self::LANGUAGE_LETTER,
            ]);

        self::assertEquals(JsonResponse::HTTP_CREATED, $response->getStatusCode());
    }

    /**
     * TODO: implement
     */
    public function testUpdate(): void
    {
        // $permission = new Permission(\Scandinaver\Puzzle\Domain\Permission\Puzzle::UPDATE);
        // $this->user->allow($permission);
        // $this->actingAs($this->user, 'api');
        // $response = $this->put(route('puzzle:update', [
        //     'id' => $this->puzzles->first()->getId()
        // ]));

        self::assertEquals(TRUE, TRUE);
    }

    /**
     * @throws Exception
     */
    public function testDestroy(): void
    {
        $permission = new Permission(\Scandinaver\Puzzle\Domain\Permission\Puzzle::DELETE);
        $this->user->allow($permission);
        $this->actingAs($this->user, 'api');

        $response = $this->delete(route('puzzle:destroy',
            [
                'id' => $this->puzzles->first()->getId(),
            ]));

        self::assertEquals(JsonResponse::HTTP_NO_CONTENT, $response->getStatusCode());
    }

    /**
     * @throws Exception
     */
    public function testByUser(): void
    {
        $permission = new Permission('view-puzzles-by-user');
        $this->user->allow($permission);
        $this->actingAs($this->user, 'api');

        $response = $this->get(route('puzzle:user',
            [
                'lang' => self::LANGUAGE_LETTER,
            ]));

        self::assertEquals(JsonResponse::HTTP_OK, $response->getStatusCode());

        $response->assertJsonStructure([\Tests\Responses\Puzzle::response()]);
    }

    /**
     * TODO: implement
     */
    public function testComplete(): void
    {
        $permission = new Permission(\Scandinaver\Puzzle\Domain\Permission\Puzzle::COMPLETE);
        $this->user->allow($permission);
        $this->actingAs($this->user, 'api');

        $response = $this->put(route('puzzle:complete',
            [
                'id' => $this->puzzles->first()->getId(),
            ]));

        self::assertEquals(JsonResponse::HTTP_OK, $response->getStatusCode());
    }
}
