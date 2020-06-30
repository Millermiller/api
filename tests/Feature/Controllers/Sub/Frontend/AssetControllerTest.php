<?php


namespace Tests\Feature\Controllers\Sub\Frontend;

use Scandinaver\Common\Domain\Language;
use Scandinaver\Learn\Domain\Asset;
use Scandinaver\Learn\Domain\Result;
use Scandinaver\User\Domain\User;
use Tests\TestCase;

/**
 * Class AssetControllerTest
 * @package Tests\Feature\Controllers\Sub\Frontend
 */
class AssetControllerTest extends TestCase
{
    /**
     * @var User
     */
    private $user;

    /**
     * @var Asset
     */
    private $asset;

    /**
     * @var Asset
     */
    private $favouriteAsset;

    public function setUp()
    {
        parent::setUp();

        /** @var Language $language */
        $language = entity(Language::class)->create();

        $this->user           = entity(User::class)->create();
        $this->asset          = entity(Asset::class)->create(['user' => $this->user, 'language' => $language]);
        $this->favouriteAsset = entity(Asset::class)->create(['user' => $this->user, 'language' => $language, 'favorite' => 1]);

        entity(Result::class)->create(['user' => $this->user, 'language' => $language, 'asset' => $this->asset]);
        entity(Result::class)->create(['user' => $this->user, 'language' => $language, 'asset' =>  $this->favouriteAsset]);
    }

    public function testShow()
    {
        $this->actingAs($this->user, 'api');

        $response = $this->get(route('sub_frontend::asset.show', ['language' => 'is','asset' => $this->asset->getId()]));

        $response->assertJsonStructure(['type', 'cards' => [
            [
                'id',
                'asset_id',
                'word_id',
                'translate_id',
                'favourite',
                'word' => [
                    'id',
                    'word',
                    'audio',
                    'sentence',
                    'is_public',
                    'creator',
                    'language' =>[
                        'name',
                        'flag',
                        'letter',
                        'cards',
                    ]
                ],
                'translate' => [
                    'id',
                    'value',
                    'word_id',
                    'word' => [
                        'id',
                        'word',
                        'audio',
                        'sentence',
                        'is_public',
                        'creator',
                        'language' =>[
                            'name',
                            'flag',
                            'letter',
                            'cards',
                        ]
                    ]
                ],
            ]
        ], 'title']);

    }

    public function testStore()
    {
        $this->actingAs($this->user, 'api');

        $response = $this->post(route('sub_frontend::asset.store', ['language' => 'is']), ['title' => 'TEST CREATE ASSET']);

        $response->assertJsonStructure(
            [
                'id',
                'title',
                'type',
                'level',
                'result',
                'basic',
                'language',
                'count',
                'cards'
            ]
        );

        $data = $response->decodeResponseJson();
        $this->assertEquals('TEST CREATE ASSET', $data['title']);
    }

    public function testUpdate()
    {
        $this->actingAs($this->user, 'api');

        $response = $this->put(route('sub_frontend::asset.update', [
            'domain' => 'is',
            'title' => 'TEST CREATE ASSET',
            'asset' => $this->asset->getId()
        ]));

        $response->assertJsonStructure(['id', 'title', 'basic', 'level', 'language']);

        $data = $response->decodeResponseJson();
        $this->assertEquals('TEST CREATE ASSET', $data['title']);
    }

    public function testDestroy()
    {
        $this->actingAs($this->user, 'api');

        $response = $this->delete(route('sub_frontend::asset.destroy', ['domain' => 'is', 'asset' => $this->asset->getId()]));

        $this->assertEquals(204, $response->getStatusCode());
    }

    public function testDestroyUnauthorized()
    {
        $response = $this->delete(route('sub_frontend::asset.destroy', ['domain' => 'is', 'asset' => $this->asset->getId()]));

        $this->assertEquals(403, $response->getStatusCode());
    }
}