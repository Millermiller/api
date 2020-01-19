<?php


namespace Tests\Feature\Controllers\Sub\Frontend;

use Scandinaver\Learn\Domain\Card;
use Scandinaver\User\Domain\User;
use Tests\TestCase;

/**
 * Class FavouriteControllerTest
 * @package Tests\Feature\Controllers\Sub\Frontend
 */
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
        $this->assertEquals(5, $data['asset']['id']);
    }

    public function testDestroy()
    {
        $user = app('em')->getRepository(User::class)->find(1);
        $this->actingAs($user);

        $card = app('em')->getRepository(Card::class)->findBy(['assetId' => 5])[0];

        $response = $this->delete(route('sub_frontend::delete-favorite', ['domain' => 'is', 'id' => $card->getWord()->getId()]));

        $response->assertJsonStructure(['success']);
    }
}