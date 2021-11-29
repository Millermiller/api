<?php

namespace Tests\Feature\Controllers\Learn;

use Exception;
use Scandinaver\Common\Domain\Entity\Language;
use Scandinaver\Learning\Asset\Domain\Entity\Card;
use Scandinaver\Learning\Asset\Domain\Entity\FavouriteAsset;
use Scandinaver\Learning\Asset\Domain\Entity\Passing;
use Scandinaver\Learning\Asset\Domain\Entity\WordAsset;
use Scandinaver\RBAC\Domain\Entity\Permission;
use Scandinaver\User\Domain\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;
use Throwable;

/**
 * Class CardControllerTest
 *
 * @package Tests\Feature\Controllers\Learn
 */
class CardControllerTest extends TestCase
{
    private const LANGUAGE_LETTER = 'is';

    private User $user;

    private WordAsset $asset;

    private FavouriteAsset $favouriteAsset;

    private Card $card;

    private Language $language;

    protected function setUp(): void
    {
        parent::setUp();

        $this->language = entity(Language::class)->create(['letter' => self::LANGUAGE_LETTER]);

        $this->user  = entity(User::class)->create();
        $this->asset = entity(WordAsset::class)->create([
            'user'     => $this->user,
            'language' => $this->language,
        ]);

        $this->favouriteAsset = entity(FavouriteAsset::class)->create(
            ['user' => $this->user, 'language' => $this->language, 'favorite' => 1]
        );

        entity(Passing::class)->create(['user' => $this->user, 'language' => $this->language, 'asset' => $this->asset]);
        entity(Passing::class)->create(
            ['user' => $this->user, 'language' => $this->language, 'asset' => $this->favouriteAsset]
        );

        $this->card = entity(Card::class)->create(['language' => $this->language, 'asset' => $this->asset]);
    }

    /**
     * @throws Throwable
     */
    public function testStore(): void
    {
        $permission = new Permission(\Scandinaver\Learning\Asset\Domain\Permission\Card::CREATE);
        $this->user->allow($permission);
        $this->actingAs($this->user, 'api');

        $response = $this->post(route('card:create', [
            'language' => self::LANGUAGE_LETTER,
            'word' => 'MY_WORD',
            'translate' => 'MY_TRANSLATE'
        ]));

        self::assertEquals(Response::HTTP_CREATED, $response->getStatusCode());
        $response->assertJsonStructure(\Tests\Responses\Card::response());

        $data = $response->decodeResponseJson();
        self::assertEquals('MY_WORD', $data['term']['value']);
        self::assertEquals('MY_TRANSLATE', $data['translate']['value']);
    }

    /**
     * @throws Exception
     */
    public function testUpdate(): void
    {
        $permission = new Permission(\Scandinaver\Learning\Asset\Domain\Permission\Card::UPDATE);
        $this->user->allow($permission);
        $this->actingAs($this->user, 'api');

        $response = $this->put(route('card:update', [
            'card' => $this->card->getId(),
        ]), [
            'id'              => $this->card->getId(),
            'examples'        => [],
            'translate'       => [
                'id' => $this->card->getTranslate()->getId(),
                'value' => $this->card->getTranslate()->getValue()
            ],
            'word' => [
                'id' => $this->card->getTerm()->getId(),
                'value' => $this->card->getTerm()->getValue()
            ]
        ]);

        self::assertEquals(Response::HTTP_OK, $response->getStatusCode());
    }

    /**
     * TODO: implement
     */
    public function testSearch(): void
    {
        self::assertEquals(TRUE, TRUE);
    }

    /**
     * TODO: implement
     */
    public function testUploadSentences(): void
    {
        self::assertEquals(TRUE, TRUE);
    }
}
