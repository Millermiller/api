<?php

namespace Tests\Unit;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ApiTest extends TestCase
{
    /**
     * A basic unit test example.
     * @covers \App\Http\Controllers\Main\Frontend\ApiController
     * @return void
     */
    public function testLanguages()
    {
        $response = $this->get('/api/languages');
        $response
            ->assertJsonStructure([
                [
                    'name',
                    'letter',
                    'flag',
                    'cards'
                ]
            ]);
    }

    public function testGetAssets()
    {

        $plan = new \App\Entities\Plan();
        $plan->setId(1);

        $user = new \App\Entities\User('test', 'test@test.test', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', $plan);
        $user->setid(1);

        $this->actingAs($user, 'api');

        $response = $this->get('/api/assets/is');
        $response
            ->assertJsonStructure([
                [
                    'id',
                    'active',
                    'count',
                    'result',
                    'title',
                    'type',
                    'basic',
                    'cards' => [
                        [
                            'id',
                            'word',
                            'trans',
                            'asset_id',
                            'examples'
                        ]
                    ],
                    'available'
                ]
            ]);
    }

    public function testIncorrectLanguageName()
    {
        $plan = new \App\Entities\Plan();
        $plan->setId(1);

        $user = new \App\Entities\User('test', 'test@test.test', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', $plan);
        $user->setid(1);

        $this->actingAs($user, 'api');

        $response = $this->get('/api/assets/wronglanguagename');
        $response->assertStatus(400);
    }
}
