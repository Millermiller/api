<?php

namespace Tests\Feature\Controllers\Learn;

use Scandinaver\Common\Domain\Entity\Language;
use Scandinaver\Learn\Domain\Entity\Card;
use Scandinaver\Learn\Domain\Entity\FavouriteAsset;
use Scandinaver\Learn\Domain\Entity\Passing;
use Scandinaver\Learn\Domain\Entity\WordAsset;
use Scandinaver\User\Domain\Entity\User;
use Tests\TestCase;

/**
 * Class CardControllerTest
 *
 * @package Tests\Feature\Controllers\Learn
 */
class CardControllerTest extends TestCase
{

    private User $user;

    private WordAsset $asset;

    private FavouriteAsset $favouriteAsset;

    private Card $card;

    private Language $language;

    protected function setUp(): void
    {
        parent::setUp();

        $this->language = entity(Language::class)->create(['letter' => 'is']);

        $this->user           = entity(User::class)->create();
        $this->asset          = entity(WordAsset::class)->create(['user'     => $this->user,
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
     * TODO: implement
     */
    public function testShow()
    {
        self::assertEquals(TRUE, TRUE);
    }

    /**
     * TODO: implement
     */
    public function testUpdate()
    {
        self::assertEquals(TRUE, TRUE);
    }

    /**
     * TODO: implement
     */
    public function testSearch()
    {
        self::assertEquals(TRUE, TRUE);
    }

    /**
     * TODO: implement
     */
    public function testCreate()
    {
        self::assertEquals(TRUE, TRUE);
    }

    /**
     * TODO: implement
     */
    public function testIndex()
    {
        self::assertEquals(TRUE, TRUE);
    }
}
