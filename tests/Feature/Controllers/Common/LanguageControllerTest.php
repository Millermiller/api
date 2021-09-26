<?php

namespace Tests\Feature\Controllers\Common;

use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Scandinaver\Common\Domain\Entity\Language;
use Scandinaver\RBAC\Domain\Entity\Permission;
use Scandinaver\User\Domain\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

/**
 * Class LanguageControllerTest
 *
 * @package Tests\Feature\Controllers\Common
 */
class LanguageControllerTest extends TestCase
{

    private int $languagesNumber = 2;

    private User $user;

    private Collection $languages;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = entity(User::class)->create();

        $this->languages = entity(Language::class, $this->languagesNumber)->create(['letter' => 'is']);
    }

    public function testIndex()
    {
        $response        = $this->get(route('languages:all'));
        $decodedResponse = json_decode($response->getContent());

        self::assertEquals(Response::HTTP_OK, $response->getStatusCode());
        self::assertCount($this->languagesNumber, $decodedResponse);

        $response->assertJsonStructure(
            [
                \Tests\Responses\Language::response(),
            ]
        );
    }

    /**
     * @throws Exception
     */
    public function testStore()
    {
        $permission = entity(Permission::class)->create([
            'slug' => \Scandinaver\Common\Domain\Permission\Language::CREATE
        ]);
        $this->user->allow($permission);

        $this->actingAs($this->user, 'api');

        $testLanguageTitle  = 'TESTTITLE';
        $testLanguageLetter = 'TESTLETTER';

        $response = $this->post(
            route('languages:create'),
            [
                'description' => 'description',
                'active'      => 1,
                'title'       => $testLanguageTitle,
                'letter'      => $testLanguageLetter,
                'file'        => UploadedFile::fake()->image('file.png', 600, 600),
                'image'       => UploadedFile::fake()->image('file.png', 600, 600),
            ]
        );

        self::assertEquals(Response::HTTP_CREATED, $response->getStatusCode());

        $response->assertJsonStructure(
            \Tests\Responses\Language::response()
        );

        $response->assertJsonFragment(
            [
                'title'  => $testLanguageTitle,
                'letter' => $testLanguageLetter,
            ]
        );
    }
}
