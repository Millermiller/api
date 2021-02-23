<?php

namespace Tests\Feature\Controllers\Learn;

use Exception;
use Scandinaver\RBAC\Domain\Model\Permission;
use App\Http\Controllers\Learn\CardController;
use Scandinaver\Common\Domain\Model\Language;
use Scandinaver\Learn\Domain\Model\Card;
use Scandinaver\Learn\Domain\Model\FavouriteAsset;
use Scandinaver\Learn\Domain\Model\Result;
use Scandinaver\Learn\Domain\Model\WordAsset;
use Scandinaver\User\Domain\Model\User;
use Tests\TestCase;

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

        entity(Result::class)->create(['user' => $this->user, 'language' => $this->language, 'asset' => $this->asset]);
        entity(Result::class)->create(
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

    /**
     * @throws Exception
     */
    public function testDestroy()
    {
        $permission = new Permission(\Scandinaver\Learn\Domain\Permissions\Card::DELETE);
        $this->user->allow($permission);

        $this->actingAs($this->user, 'api');

        $response = $this->delete(
            route(
                'card:remove',
                [
                    'language' => 'is',
                    'card' => $this->card->getId(),
                    'asset' => $this->asset->getId(),
                ]
            )
        );

        static::assertEquals(204, $response->getStatusCode());
    }

    /**
     * @throws Exception
     */
    public function testStore()
    {
        /** @var Card $card */
        $card = entity(Card::class)->create(['language' => $this->language]);

        $permission = new Permission(\Scandinaver\Learn\Domain\Permissions\Card::CREATE);
        $this->user->allow($permission);

        $this->actingAs($this->user, 'api');

        $response = $this->post(
            route(
                'card:add',
                ['language' => 'is', 'card' => $card->getId(), 'asset' => 1]
            )
        );

        static::assertEquals(201, $response->getStatusCode());

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
        // $this->assertEquals(1, $data['asset']['id']);
    }
}
