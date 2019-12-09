<?php


namespace Tests\Feature\Controllers\Sub\Frontend;


use App\Entities\Asset;
use App\Entities\User;
use Illuminate\Http\Request;
use Mockery;
use Tests\TestCase;

class AssetControllerTest extends TestCase
{
    public function testShow()
    {
        $user  = app('em')->getRepository(User::class)->find(1);
        $asset = app('em')->getRepository(Asset::class)->find(1);

        $this->actingAs($user);

        $response = $this->get(route('sub_frontend::asset.show', ['domain' => 'is','asset' => $asset->getId()]));

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
                'asset' => [
                    'id',
                    'title',
                    'type',
                    'level',
                    'level',
                    'result',
                    'basic',
                    'language_id',
                    'count',
                ]
            ]
        ], 'title']);

    }

    public function testStore()
    {
        $user  = app('em')->getRepository(User::class)->find(1);
        $this->actingAs($user);

        $response = $this->post(route('sub_frontend::asset.store', ['domain' => 'is', 'title' => 'TEST CREATE ASSET']));

        $response->assertJsonStructure(
            [
                'id',
                'title',
                'type',
                'level',
                'result',
                'basic',
                'language_id',
                'count',
                'cards'
            ]
        );

        $data = $response->decodeResponseJson();
        $this->assertEquals('TEST CREATE ASSET', $data['title']);
    }

    public function testUpdate()
    {
        $user  = app('em')->getRepository(User::class)->find(1);
        $asset = app('em')->getRepository(Asset::class)->find(1);

        $this->actingAs($user);

        $response = $this->put(route('sub_frontend::asset.update', ['domain' => 'is', 'title' => 'TEST CREATE ASSET', 'asset' => $asset->getId()]));

        $response->assertJsonStructure(['id', 'title', 'basic', 'level', 'language_id']);

        $data = $response->decodeResponseJson();
        $this->assertEquals('TEST CREATE ASSET', $data['title']);
    }

    public function testDestroy()
    {
        $asset = app('em')->getRepository(Asset::class)->find(1);
        $user  = app('em')->getRepository(User::class)->find(1);
        $this->actingAs($user);

        $response = $this->delete(route('sub_frontend::asset.destroy', ['domain' => 'is', 'asset' => $asset->getId()]));

        $this->assertEquals(204, $response->getStatusCode());
    }

    public function testDestroyUnauthorized()
    {
        $asset = app('em')->getRepository(Asset::class)->find(1);

        $response = $this->delete(route('sub_frontend::asset.destroy', ['domain' => 'is', 'asset' => $asset->getId()]));

        $this->assertEquals(403, $response->getStatusCode());
    }
}