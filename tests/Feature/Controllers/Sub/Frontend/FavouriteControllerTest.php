<?php


namespace Tests\Feature\Controllers\Sub\Frontend;

use Scandinaver\Common\Domain\Model\Language;
use Scandinaver\Learn\Domain\Model\Asset;
use Scandinaver\Learn\Domain\Model\Card;
use Scandinaver\Learn\Domain\Model\FavouriteAsset;
use Scandinaver\Learn\Domain\Model\Result;
use Scandinaver\Learn\Domain\Model\WordAsset;
use Scandinaver\User\Domain\Model\User;
use Tests\TestCase;

/**
 * Class FavouriteControllerTest
 * @package Tests\Feature\Controllers\Sub\Frontend
 */
class FavouriteControllerTest extends TestCase
{

    /**
     * @var User
     */
    private $user;

    /**
     * @var WordAsset
     */
    private $wordasset;

    /**
     * @var FavouriteAsset
     */
    private $favouriteAsset;

    /**
     * @var Card
     */
    private $card;

    /**
     * @var Card
     */
    private $favouriteCard;

    public function setUp()
    {
        parent::setUp();

        /** @var Language $language */
        $language = entity(Language::class)->create();

        $this->user           = entity(User::class)->create();
        $this->wordasset      = entity(WordAsset::class)->create(['user' => $this->user, 'language' => $language]);
        $this->favouriteAsset = entity(FavouriteAsset::class)->create(['user' => $this->user, 'language' => $language, 'favorite' => 1]);

        entity(Result::class)->create(['user' => $this->user, 'language' => $language, 'asset' => $this->wordasset]);
        entity(Result::class)->create(['user' => $this->user, 'language' => $language, 'asset' =>  $this->favouriteAsset]);

        $this->card = entity(Card::class)->create(['language' => $language, 'asset' => $this->wordasset ]);
        $this->favouriteCard = entity(Card::class)->create(['language' => $language, 'asset' => $this->favouriteAsset ]);
    }

    public function testStore()
    {
        $this->actingAs($this->user, 'api');

        $response = $this->post(
            route(
                'sub_frontend::add-favorite',
                ['language' => 'is', 'card' => $this->card->getId()]
            )
        );

        $this->assertEquals(201, $response->getStatusCode());

        // $response->assertJsonStructure(
        //     [
        //         'id',
        //         'asset_id',
        //         'word_id',
        //         'translate_id',
        //         'id',
        //         'favourite',
        //         'word' => [],
        //         'translate' => [],
        //         'asset' => [],
        //     ]
        // );

        // $data = $response->decodeResponseJson();

        // $this->assertEquals(1, $data['word']['id']);
        // $this->assertEquals(1, $data['translate']['id']);
        // $this->assertEquals(5, $data['asset']['id']);
    }

    public function testDestroy()
    {
        $this->actingAs($this->user, 'api');

        $response = $this->delete(route('sub_frontend::delete-favorite', [
            'language' => 'is', 'id' => $this->favouriteCard->getId()
        ]));

        $this->assertEquals(204, $response->getStatusCode());
    }
}