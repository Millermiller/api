<?php

namespace Tests\Feature\Controllers\Learn;

use Scandinaver\Common\Domain\Model\Language;
use Scandinaver\Learn\Domain\Model\Card;
use Scandinaver\Learn\Domain\Model\FavouriteAsset;
use Scandinaver\Learn\Domain\Model\Passing;
use Scandinaver\Learn\Domain\Model\WordAsset;
use Scandinaver\User\Domain\Model\User;
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

        $this->language = entity(Language::class)->create(['name' => 'is']);

        $this->user = entity(User::class)->create();
        $this->asset = entity(WordAsset::class)->create(['user' => $this->user, 'language' => $this->language]);
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
        self::assertEquals(true, true);
    }

    /**
     * TODO: implement
     */
    public function testUpdate()
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

    /**
     * TODO: implement
     */
    public function testCreate()
    {
        self::assertEquals(true, true);
    }

    /**
     * TODO: implement
     */
    public function testIndex()
    {
        self::assertEquals(true, true);
    }
}
