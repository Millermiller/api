<?php


namespace Tests\Unit;

use Scandinaver\User\Domain\Plan;
use Scandinaver\User\Domain\User;
use Tests\TestCase;

/**
 * Class ApiTest
 * @package Tests\Unit
 */
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
        $plan = new Plan();
        $plan->setId(1);

        $user = new User();
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
        $plan = new Plan();
        $plan->setId(1);

        $user = new User();
        $user->setid(1);

        $this->actingAs($user, 'api');

        $response = $this->get('/api/assets/wronglanguagename');
        $response->assertStatus(400);
    }
}
