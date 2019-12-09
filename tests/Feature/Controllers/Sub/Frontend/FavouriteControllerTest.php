<?php


namespace Tests\Feature\Controllers\Sub\Frontend;

use App\Entities\User;
use Tests\TestCase;

class FavouriteControllerTest extends TestCase
{

    public function testStore()
    {
        $user = app('em')->getRepository(User::class)->find(1);
        $this->actingAs($user);

        $response = $this->post(
            route(
                'sub_frontend::add-favorite',
                ['domain' => 'is', 'word_id' => 1, 'translate_id' => 1]
            )
        );

        $this->assertEquals(201, $response->getStatusCode());

        $response->assertJsonStructure(
            [
                'id',
                'asset_id',
                'word_id',
                'translate_id',
                'id',
                'favourite',
                'word' => [],
                'translate' => [],
                'asset' => [],
            ]
        );

        $data = $response->decodeResponseJson();

        $this->assertEquals(1, $data['word']['id']);
        $this->assertEquals(1, $data['translate']['id']);
        $this->assertEquals(1, $data['asset']['id']);
    }

    public function testDestroy()
    {
        $user = app('em')->getRepository(User::class)->find(1);
        $this->actingAs($user);

        $response = $this->delete(route('sub_frontend::delete-favorite', ['domain' => 'is', 'id' => 19]));

        $response->assertJsonStructure(['success']);
    }
}