<?php

namespace Tests\Feature\Controllers\Learn;

use Exception;
use Mockery\MockInterface;
use Scandinaver\Common\Domain\Entity\Language;
use Scandinaver\Learning\Asset\Domain\Contract\Repository\TranslateRepositoryInterface;
use Scandinaver\Learning\Asset\Domain\Entity\Card;
use Scandinaver\Learning\Asset\Domain\Entity\FavouriteAsset;
use Scandinaver\Learning\Asset\Domain\Entity\Passing;
use Scandinaver\Learning\Asset\Domain\Entity\PersonalAsset;
use Scandinaver\Learning\Asset\Domain\Entity\SentenceAsset;
use Scandinaver\Learning\Asset\Domain\Entity\WordAsset;
use Scandinaver\Learning\Asset\Domain\Enum\AssetType;
use Scandinaver\Learning\Asset\Domain\Service\AudioService;
use Scandinaver\RBAC\Domain\Entity\Permission;
use Scandinaver\User\Domain\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;
use Throwable;

/**
 * Class AssetControllerTest
 *
 * @package Tests\Feature\Controllers\Learn
 */
class AssetControllerTest extends TestCase
{

    private const LANGUAGE_LETTER = 'is';

    private User $user;

    private WordAsset $asset;

    private Card $card;

    private FavouriteAsset $favouriteAsset;

    private Language $language;

    private PersonalAsset $personalAsset;

    /**
     * @throws Exception
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->language = entity(Language::class)->create(['letter' => self::LANGUAGE_LETTER]);

        $this->user = entity(User::class)->create();

        $this->asset = entity(WordAsset::class)->create([
            'user'     => $this->user,
            'language' => $this->language,
        ]);

        entity(SentenceAsset::class)->create([
            'user'     => $this->user,
            'language' => $this->language,
        ]);

        $this->favouriteAsset = entity(FavouriteAsset::class)->create(
            ['user' => $this->user, 'language' => $this->language, 'favorite' => 1]
        );

        $this->personalAsset = entity(PersonalAsset::class)->create(
            ['user' => $this->user, 'language' => $this->language, 'favorite' => 1]
        );

        $this->card = entity(Card::class)->create(['language' => $this->language, 'asset' => $this->asset]);

        $passing = entity(Passing::class)->create([
            'user'     => $this->user,
            'asset'    => $this->asset,
            'language' => $this->language,
        ]);
        $this->user->addAssetPassing($passing);
        $passing = entity(Passing::class)->create([
            'user'     => $this->user,
            'asset'    => $this->favouriteAsset,
            'language' => $this->language,
        ]);
        $this->user->addAssetPassing($passing);

        $this->favouriteAsset->setOwner($this->user);
        $this->user->addPersonalAsset($this->favouriteAsset);

        $this->personalAsset->setOwner($this->user);
        $this->user->addPersonalAsset($this->personalAsset);
    }

    /**
     * @throws Exception
     */
    public function testIndex(): void
    {
        $permission = entity(Permission::class, 1)->create([
            'slug' => \Scandinaver\Learning\Asset\Domain\Permission\Asset::VIEW,
        ]);
        $this->user->allow($permission);
        $this->actingAs($this->user, 'api');

        $response = $this->get(route('asset:all', ['lang' => self::LANGUAGE_LETTER]));

        $response->assertStatus(Response::HTTP_OK)
                 ->assertJsonStructure(
                     \Tests\Responses\Asset::responseWithoutCards()
                 );
    }

    /**
     * @throws Throwable
     */
    public function testShow(): void
    {
        $permission = entity(Permission::class, 1)->create([
            'slug' => \Scandinaver\Learning\Asset\Domain\Permission\Asset::SHOW,
        ]);
        $this->user->allow($permission);

        $this->actingAs($this->user, 'api');

        $response = $this->get(
            route('asset:show', ['id' => $this->asset->getId()])
        );

        $response->assertJsonStructure(
            \Tests\Responses\Asset::singleResponse()
        );
    }

    /**
     * @throws Throwable
     */
    public function testStore(): void
    {
        $permission = entity(Permission::class, 1)->create([
            'slug' => \Scandinaver\Learning\Asset\Domain\Permission\Asset::CREATE,
        ]);
        $this->user->allow($permission);
        $this->actingAs($this->user, 'api');

        $testTitle = 'TEST CREATE ASSET';

        $this->post(route('asset:store'),
            [
                'language' => 'is',
                'title'    => $testTitle,
                'level'    => 2,
                'type'     => AssetType::WORDS->value,
                'basic'    => TRUE,
            ])
             ->assertStatus(Response::HTTP_CREATED)
             ->assertJsonStructure(\Tests\Responses\Asset::singleResponse())
             ->assertJsonFragment(['title' => $testTitle]);
    }

    /**
     * @throws Throwable
     */
    public function testUpdate(): void
    {
        $permission = entity(Permission::class, 1)->create([
            'slug' => \Scandinaver\Learning\Asset\Domain\Permission\Asset::UPDATE,
        ]);
        $this->user->allow($permission);
        $this->actingAs($this->user, 'api');

        $testTitle = 'TEST UPDATE ASSET';

        $response = $this->put(route('asset:update',
            [
                'id'    => $this->asset->getId(),
                'type'  => AssetType::WORDS->value,
                'level' => 2,
            ]),
            [
                'title' => $testTitle,
            ]);

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure(\Tests\Responses\Asset::singleResponseWithoutCards());
        $response->assertJsonFragment(['title' => $testTitle]);
    }

    /**
     * @throws Exception
     */
    public function testDestroy(): void
    {
        $permission = entity(Permission::class, 1)->create([
            'slug' => \Scandinaver\Learning\Asset\Domain\Permission\Asset::DELETE,
        ]);
        $this->user->allow($permission);

        $this->actingAs($this->user, 'api');

        $this->delete(route('asset:destroy',
            [
                'id' => $this->asset->getId(),
            ]
        ))
             ->assertStatus(Response::HTTP_NO_CONTENT);
    }

    /**
     * @throws Throwable
     */
    public function testGetPersonalAssets(): void
    {
        $permission = entity(Permission::class, 1)->create([
            'slug' => \Scandinaver\Learning\Asset\Domain\Permission\Asset::VIEW,
        ]);
        $this->user->allow($permission);
        $this->actingAs($this->user, 'api');

        $this->get(route('asset:personal', ['lang' => self::LANGUAGE_LETTER]))
             ->assertStatus(Response::HTTP_OK)
             ->assertJsonStructure(\Tests\Responses\Asset::responseWithoutCards())
             ->assertJsonFragment(['title' => $this->personalAsset->getTitle()])
             ->assertJsonFragment(['category' => AssetType::PERSONAL->value]);
    }

    /**
     * @throws Exception
     */
    public function testFindAudio(): void
    {
        $permission = entity(Permission::class, 1)->create([
            'slug' => \Scandinaver\Learning\Asset\Domain\Permission\Asset::VIEW,
        ]);
        $this->user->allow($permission);
        $this->actingAs($this->user, 'api');

        $this->mock(AudioService::class,
            function (MockInterface $mock) {
                $mock->shouldReceive('parse')
                     ->once()
                     ->andReturn($this->card->getTerm());
            });

        $response = $this->post(route('asset:forvo', ['id' => 1]));

        self::assertEquals(Response::HTTP_OK, $response->getStatusCode());

        $response->assertJsonStructure([
            'data' => [
                'id',
                'type',
                'attributes' => [
                    'value',
                ],
            ],
        ]);
    }

    /**
     * TODO: implement
     *
     * @throws Exception
     */
    public function testShowValues(): void
    {
        $permission = entity(Permission::class, 1)->create([
            'slug' => \Scandinaver\Learning\Asset\Domain\Permission\Asset::VIEW,
        ]);
        $this->user->allow($permission);
        $this->actingAs($this->user, 'api');

        $this->mock(TranslateRepositoryInterface::class,
            function (MockInterface $mock) {
                $mock->shouldReceive('searchByIds')
                     ->once()
                     ->andReturn([$this->card->getTranslate()->getId()]);
            });

        $response = $this->get(route('asset:values:show',
            [
                'word' => $this->card->getTerm()->getId(),
            ]));

        // self::assertEquals(JsonResponse::HTTP_OK, $response->getStatusCode());

        //  $response->assertJsonStructure(['id', 'value']);

        self::assertEquals(TRUE, TRUE);
    }

    /**
     * @throws Exception
     */
    public function testShowExamples(): void
    {
        $permission = entity(Permission::class, 1)->create([
            'slug' => \Scandinaver\Learning\Asset\Domain\Permission\Asset::VIEW,
        ]);
        $this->user->allow($permission);
        $this->actingAs($this->user, 'api');

        $this->get(route('asset:examples',
                [
                    'card' => $this->card->getId(),
                ])
        )
             ->assertStatus(Response::HTTP_OK)
             ->assertJsonStructure(\Tests\Responses\Example::collectionResponse());
    }

    /**
     * TODO: implement
     */
    public function testEditTranslate(): void
    {
        self::assertEquals(TRUE, TRUE);
    }

    /**
     * TODO: implement
     */
    public function testUploadAudio(): void
    {
        self::assertEquals(TRUE, TRUE);
    }

    /**
     * TODO: implement
     */
    public function testAddPair(): void
    {
        self::assertEquals(TRUE, TRUE);
    }

    /**
     * @throws Exception
     */
    public function testAddCard(): void
    {
        $permission = entity(Permission::class, 1)->create([
            'slug' => \Scandinaver\Learning\Asset\Domain\Permission\Asset::ADD_CARD,
        ]);
        $this->user->allow($permission);
        $this->actingAs($this->user, 'api');

        $this->post(route(
            'asset:card:add',
            [
                'asset' => $this->asset->getId(),
                'card'  => $this->card->getId(),
            ]
        ))
             ->assertStatus(Response::HTTP_CREATED);
    }

    /**
     * @throws Exception
     */
    public function testRemoveCard(): void
    {
        $permission = entity(Permission::class, 1)->create([
            'slug' => \Scandinaver\Learning\Asset\Domain\Permission\Card::DELETE,
        ]);
        $this->user->allow($permission);
        $this->actingAs($this->user, 'api');

        $this->delete(route(
            'asset:card:remove',
            [
                'asset' => $this->asset->getId(),
                'card'  => $this->card->getId(),
            ]
        ))
             ->assertStatus(Response::HTTP_NO_CONTENT);
    }

    /**
     * TODO: implement
     */
    public function testAssetsMobile(): void
    {
        self::assertEquals(TRUE, TRUE);
    }
}
