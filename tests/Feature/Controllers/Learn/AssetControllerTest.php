<?php

namespace Tests\Feature\Controllers\Learn;

use Exception;
use Illuminate\Http\JsonResponse;
use Scandinaver\Common\Domain\Entity\Language;
use Scandinaver\Learn\Domain\Entity\Asset;
use Scandinaver\Learn\Domain\Entity\Card;
use Scandinaver\Learn\Domain\Entity\FavouriteAsset;
use Scandinaver\Learn\Domain\Entity\Passing;
use Scandinaver\Learn\Domain\Entity\WordAsset;
use Scandinaver\RBAC\Domain\Entity\Permission;
use Scandinaver\User\Domain\Entity\User;
use Tests\TestCase;
use Throwable;

/**
 * Class AssetControllerTest
 *
 * @package Tests\Feature\Controllers\Learn
 */
class AssetControllerTest extends TestCase
{

    private User $user;

    private WordAsset $asset;

    private Card $card;

    private FavouriteAsset $favouriteAsset;

    private Language $language;

    /**
     * @throws Exception
     */
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
        $this->card           = entity(Card::class)->create(['language' => $this->language, 'asset' => $this->asset]);

        $passing = entity(Passing::class)->create(['user'     => $this->user,
                                                   'asset'    => $this->asset,
                                                   'language' => $this->language,
        ]);
        $this->user->addAssetPassing($passing);
        $passing = entity(Passing::class)->create(['user'     => $this->user,
                                                   'asset'    => $this->favouriteAsset,
                                                   'language' => $this->language,
        ]);
        $this->user->addAssetPassing($passing);

        $this->favouriteAsset->setOwner($this->user);
        $this->user->addPersonalAsset($this->favouriteAsset);
    }

    /**
     * @throws Throwable
     */
    public function testShow()
    {
        $permission = new Permission(\Scandinaver\Learn\Domain\Permission\Asset::SHOW);
        $this->user->allow($permission);

        $this->actingAs($this->user, 'api');

        $response = $this->get(
            route('asset:show', ['id' => $this->asset->getId()])
        );

        $response->assertJsonStructure(
            [
                'id',
                'type',
                'title',
                'level',
                'count',
                'language',
                'cards' => [
                    [
                        'id',
                        'favourite',
                        'term'      => [
                            'id',
                            'value',
                        ],
                        'translate' => [
                            'id',
                            'value',
                        ],
                    ],
                ],
            ]
        );
    }

    /**
     * @throws Throwable
     */
    public function testUpdate()
    {
        $permission = new Permission(\Scandinaver\Learn\Domain\Permission\Asset::UPDATE);
        $this->user->allow($permission);
        $this->actingAs($this->user, 'api');

        $response = $this->put(
            route(
                'asset:update',
                [
                    'id'    => $this->asset->getId(),
                    'type'  => Asset::TYPE_WORDS,
                    'level' => 2,
                ]
            ),
            [
                'title' => 'TEST UPDATE ASSET',
            ]
        );

        $response->assertJsonStructure(['id', 'title', 'level', 'language']);

        $data = $response->decodeResponseJson();
        static::assertEquals('TEST UPDATE ASSET', $data['title']);
    }

    /**
     * @throws Exception
     */
    public function testIndex()
    {
        $permission = new Permission(\Scandinaver\Learn\Domain\Permission\Asset::VIEW);
        $this->user->allow($permission);

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
     * @throws Exception
     */
    public function testAddCard()
    {
        $permission = new Permission(\Scandinaver\Learn\Domain\Permission\Asset::ADD_CARD);
        $this->user->allow($permission);
        $this->actingAs($this->user, 'api');

        $response = $this->post(route(
            'asset:card:add',
            [
                'asset' => $this->asset->getId(),
                'card'  => $this->card->getId(),
            ]
        ));

        self::assertEquals(JsonResponse::HTTP_CREATED, $response->getStatusCode());
    }

    /**
     * @throws Exception
     */
    public function testRemoveCard()
    {
        $permission = new Permission(\Scandinaver\Learn\Domain\Permission\Card::DELETE);
        $this->user->allow($permission);
        $this->actingAs($this->user, 'api');

        $response = $this->delete(route(
            'asset:card:remove',
            [
                'asset' => $this->asset->getId(),
                'card'  => $this->card->getId(),
            ]
        ));

        self::assertEquals(JsonResponse::HTTP_NO_CONTENT, $response->getStatusCode());
    }

    /**
     * TODO: implement
     */
    public function testGetWords()
    {
        self::assertEquals(TRUE, TRUE);
    }

    /**
     * TODO: implement
     */
    public function testGetPersonal()
    {
        self::assertEquals(TRUE, TRUE);
    }

    /**
     * TODO: implement
     */
    public function testShowAsset()
    {
        self::assertEquals(TRUE, TRUE);
    }

    /**
     * TODO: implement
     */
    public function testShowValues()
    {
        self::assertEquals(TRUE, TRUE);
    }

    /**
     * TODO: implement
     */
    public function testChangeAsset()
    {
        self::assertEquals(TRUE, TRUE);
    }

    /**
     * TODO: implement
     */
    public function testGetAllSentences()
    {
        self::assertEquals(TRUE, TRUE);
    }

    /**
     * TODO: implement
     */
    public function testAddBasicAssetLevel()
    {
        self::assertEquals(TRUE, TRUE);
    }

    /**
     * TODO: implement
     */
    public function testAddPair()
    {
        self::assertEquals(TRUE, TRUE);
    }

    /**
     * TODO: implement
     */
    public function testEditTranslate()
    {
        self::assertEquals(TRUE, TRUE);
    }

    /**
     * TODO: implement
     */
    public function testAssetsMobile()
    {
        self::assertEquals(TRUE, TRUE);
    }

    /**
     * TODO: implement
     */
    public function testShowExamples()
    {
        self::assertEquals(TRUE, TRUE);
    }

    /**
     * TODO: implement
     */
    public function testChangeUsedTranslate()
    {
        self::assertEquals(TRUE, TRUE);
    }

    /**
     * @throws Throwable
     */
    public function testStore()
    {
        $permission = new Permission(\Scandinaver\Learn\Domain\Permission\Asset::CREATE);
        $this->user->allow($permission);
        $this->actingAs($this->user, 'api');

        $response = $this->post(route('asset:store'),
            [
                'language' => 'is',
                'title'    => 'TEST CREATE ASSET',
                'level'    => 2,
                'type'     => Asset::TYPE_WORDS,
                'basic'    => TRUE,
            ]);

        $response->assertJsonStructure(
            [
                'id',
                'title',
                'level',
                'language',
                'count',
                'cards',
            ]
        );

        $data = $response->decodeResponseJson();
        static::assertEquals('TEST CREATE ASSET', $data['title']);
    }

    /**
     * TODO: implement
     */
    public function testFindAudio()
    {
        self::assertEquals(TRUE, TRUE);
    }

    /**
     * @throws Exception
     */
    public function testDestroy()
    {
        $permission = new Permission(\Scandinaver\Learn\Domain\Permission\Asset::DELETE);
        $this->user->allow($permission);

        $this->actingAs($this->user, 'api');

        $response = $this->delete(route('asset:destroy', ['id' => $this->asset->getId()]));

        static::assertEquals(204, $response->getStatusCode());
    }

    /**
     * TODO: implement
     */
    public function testGetSentences()
    {
        self::assertEquals(TRUE, TRUE);
    }

    /**
     * TODO: implement
     */
    public function testUploadSentences()
    {
        self::assertEquals(TRUE, TRUE);
    }

    /**
     * TODO: implement
     */
    public function testUploadAudio()
    {
        self::assertEquals(TRUE, TRUE);
    }
}
