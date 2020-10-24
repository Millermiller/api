<?php

namespace Tests\Feature\Controllers\Learn;

use App\Http\Controllers\Learn\AssetController;
use Illuminate\Http\JsonResponse;
use Scandinaver\Common\Domain\Model\Language;
use Scandinaver\Learn\Domain\Model\Card;
use Scandinaver\Learn\Domain\Model\FavouriteAsset;
use Scandinaver\Learn\Domain\Model\Result;
use Scandinaver\Learn\Domain\Model\WordAsset;
use Scandinaver\User\Domain\Model\User;
use Tests\TestCase;

class AssetControllerTest extends TestCase
{

    private User $user;

    private WordAsset $asset;

    private Card $card;

    private FavouriteAsset $favouriteAsset;

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
        $this->card = entity(Card::class)->create(['language' => $this->language, 'asset' => $this->asset]);

        entity(Result::class)->create(['user' => $this->user, 'language' => $this->language, 'asset' => $this->asset]);
        entity(Result::class)->create(
            ['user' => $this->user, 'language' => $this->language, 'asset' => $this->favouriteAsset]
        );
    }

    public function testUpdate()
    {
        $this->actingAs($this->user, 'api');

        $response = $this->put(
            route(
                'asset.update',
                [
                    'language' => 'is',
                    'title' => 'TEST UPDATE ASSET',
                    'asset' => $this->asset->getId(),
                ]
            )
        );

        $response->assertJsonStructure(['id', 'title', 'basic', 'level', 'language']);

        $data = $response->decodeResponseJson();
        static::assertEquals('TEST UPDATE ASSET', $data['title']);
    }

    public function testIndex()
    {
        $this->actingAs($this->user, 'api');

        $response = $this->get('/is/assets');

        self::assertEquals(JsonResponse::HTTP_OK, $response->getStatusCode());

        $response->assertJsonStructure(
            [
                'words',
                'sentences',
            ]
        );
    }

    /**
     * TODO: implement
     */
    public function testGetWords()
    {
        self::assertEquals(true, true);
    }

    /**
     * TODO: implement
     */
    public function testGetPersonal()
    {
        self::assertEquals(true, true);
    }

    /**
     * TODO: implement
     */
    public function testShowAsset()
    {
        self::assertEquals(true, true);
    }

    /**
     * TODO: implement
     */
    public function testShowValues()
    {
        self::assertEquals(true, true);
    }

    /**
     * TODO: implement
     */
    public function testChangeAsset()
    {
        self::assertEquals(true, true);
    }

    /**
     * TODO: implement
     */
    public function testGetAllSentences()
    {
        self::assertEquals(true, true);
    }

    /**
     * TODO: implement
     */
    public function testAddBasicAssetLevel()
    {
        self::assertEquals(true, true);
    }

    /**
     * TODO: implement
     */
    public function testAddPair()
    {
        self::assertEquals(true, true);
    }

    /**
     * TODO: implement
     */
    public function testEditTranslate()
    {
        self::assertEquals(true, true);
    }

    /**
     * TODO: implement
     */
    public function testAssetsMobile()
    {
        self::assertEquals(true, true);
    }

    /**
     * TODO: implement
     */
    public function testShowExamples()
    {
        self::assertEquals(true, true);
    }

    /**
     * TODO: implement
     */
    public function testChangeUsedTranslate()
    {
        self::assertEquals(true, true);
    }

    public function testStore()
    {
        $this->actingAs($this->user, 'api');

        $response = $this->post(route('asset.store', ['language' => 'is']), ['title' => 'TEST CREATE ASSET']);

        $response->assertJsonStructure(
            [
                'id',
                'title',
                'level',
              //  'result',
                'basic',
                'language',
                'count',
                'cards',
            ]
        );

        $data = $response->decodeResponseJson();
        static::assertEquals('TEST CREATE ASSET', $data['title']);
    }

    public function testShow()
    {
        $this->actingAs($this->user, 'api');

        $response = $this->get(
            route('asset.show', ['language' => $this->language->getName(), 'asset' => $this->asset->getId()])
        );

        $response->assertJsonStructure(
            [
                'type',
                'cards' => [
                    [
                        'id',
                        'favourite',
                        'word' => [
                            'id',
                            'value',
                            'audio',
                            'sentence',
                            'is_public',
                            'creator',
                        ],
                        'translate' => [
                            'id',
                            'value',
                            'word' => [
                                'id',
                                'value',
                                'audio',
                                'sentence',
                                'is_public',
                                'creator',
                            ],
                        ],
                    ],
                ],
                'title',
            ]
        );
    }

    /**
     * TODO: implement
     */
    public function testFindAudio()
    {
        self::assertEquals(true, true);
    }

    public function testDestroy()
    {
        $this->actingAs($this->user, 'api');

        $response = $this->delete(route('asset.destroy', ['language' => 'is', 'asset' => $this->asset->getId()]));

        static::assertEquals(204, $response->getStatusCode());
    }

    /**
     * TODO: implement
     */
    public function testGetSentences()
    {
        self::assertEquals(true, true);
    }

    /**
     * TODO: implement
     */
    public function testUploadSentences()
    {
        self::assertEquals(true, true);
    }

    /**
     * TODO: implement
     */
    public function testUploadAudio()
    {
        self::assertEquals(true, true);
    }
}
