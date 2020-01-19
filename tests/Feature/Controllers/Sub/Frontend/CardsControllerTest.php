<?php


namespace Tests\Feature\Controllers\Sub\Frontend;

use Scandinaver\Learn\Domain\Card;
use Scandinaver\User\Domain\User;
use Tests\TestCase;

/**
 * Class CardsControllerTest
 * @package Tests\Feature\Controllers\Sub\Frontend
 */
class CardsControllerTest extends TestCase
{
    public function testStore()
    {
        $user = app('em')->getRepository(User::class)->find(1);
        $this->actingAs($user);

        $response = $this->post(
            route(
                'sub_frontend::card.store',
                ['domain' => 'is', 'word_id' => 1, 'asset_id' => 1, 'translate_id' => 1]
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
        $card = app('em')->getRepository(Card::class)->find(26);

        $user = app('em')->getRepository(User::class)->find(1);
        $this->actingAs($user);

        $response = $this->delete(route('sub_frontend::card.destroy', ['domain' => 'is', 'card' => $card->getId()]));

        $this->assertEquals(204, $response->getStatusCode());
    }

    public function getSentences()
    {

    }

}