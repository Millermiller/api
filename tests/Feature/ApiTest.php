<?php


namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Scandinaver\Common\Domain\Model\Language;
use Scandinaver\Learn\Domain\Model\Asset;
use Scandinaver\Learn\Domain\Model\WordAsset;
use Scandinaver\User\Domain\Model\Plan;
use Scandinaver\User\Domain\Model\User;
use Tests\TestCase;

/**
 * Class ApiTest
 *
 * @package Tests\Feature
 */
class ApiTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        /** @var Language $language */
        $language = entity(Language::class)->create();
        $plan   = entity(Plan::class)->create();
        $user   = entity(User::class)->create();
        $assets = entity(WordAsset::class, 2)->create(['user' => $user, 'language' => $language])->toArray();

        foreach ($assets as $asset) {
         // $cards = entity(\Scandinaver\Learn\Domain\Card::class, 2)->create(['asset' => $asset])->toArray();
        }
    }

    public function tearDown()
    {
        parent::tearDown(); // TODO: Change the autogenerated stub
    }

    /**
     * @covers \App\Http\Controllers\Main\Frontend\ApiController
     * @return void
     */
    public function testLanguages()
    {
        $response = $this->get('/languages');
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

        $response = $this->get("/assets/is");
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

        $response = $this->get('/assets/wronglanguagename');
        $response->assertStatus(500);
    }
}
