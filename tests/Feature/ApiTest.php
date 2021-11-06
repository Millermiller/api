<?php


namespace Tests\Feature;

use Scandinaver\Common\Domain\Entity\Language;
use Scandinaver\Learning\Asset\Domain\Entity\WordAsset;
use Scandinaver\User\Domain\Entity\User;
use Tests\TestCase;

/**
 * Class ApiTest
 *
 * @package Tests\Feature
 */
class ApiTest extends TestCase
{

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();

        /** @var Language $language */
        $language   = entity(Language::class)->create(['letter' => 'is']);
        $this->user = entity(User::class)->create();
        $assets     = entity(WordAsset::class, 2)->create(['user' => $this->user, 'language' => $language])->toArray();

        foreach ($assets as $asset) {
            // $cards = entity(\Scandinaver\Learn\Domain\Card::class, 2)->create(['asset' => $asset])->toArray();
        }
    }

    public function testLanguages()
    {
        $response = $this->get(route('languages:all'));
        $response->assertJsonStructure([
            \Tests\Responses\Language::response()
        ]);
    }

   // public function testIncorrectLanguageName()
   // {
   //     $this->actingAs($this->user, 'api');
   //     $response = $this->get('/wronglanguagename/assets-mobile');
   //     $response->assertStatus(404);
   // }

    /*
        public function testGetAssets()
        {
            $this->actingAs($this->user, 'api');

            $response = $this->get(route('asset:mobile', ['language' => 'is']));
            $response->assertJsonStructure([
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
    */

    // public function testExample()
    // {
    //     $handlerMock = $this->getMockBuilder(LanguagesHandlerInterface::class)
    //         ->setMethods(['handle'])
    //         ->getMock();
    //     $handlerMock->method('handle')->willReturn('foo');

    //     $this->app->bind(LanguagesHandler::class, function() use ($handlerMock){
    //         return $handlerMock;
    //     });

    //     $response = $this->get('/languages');
    //     $data = $response->decodeResponseJson();
    //     $data->assertExact(['foo']);
    // }
}
