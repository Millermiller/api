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
        $user = factory(User::class)->create();

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
}
