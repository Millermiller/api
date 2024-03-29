<?php


namespace Tests\Feature\Controllers\Sub\Frontend;

use Scandinaver\Common\Domain\Entity\Language;
use Scandinaver\Learning\Asset\Domain\Entity\Asset;
use Scandinaver\Learning\Asset\Domain\Entity\Card;
use Scandinaver\Learning\Asset\Domain\Entity\FavouriteAsset;
use Scandinaver\Learning\Asset\Domain\Entity\Passing;
use Scandinaver\Learning\Asset\Domain\Entity\WordAsset;
use Scandinaver\User\Domain\Entity\User;
use Tests\TestCase;

/**
 * Class IndexControllerTest
 *
 * @package Tests\Feature\Controllers\Sub\Frontend
 */
class IndexControllerTest extends TestCase
{

    private User $user;

    private WordAsset $wordasset;

    private Asset $favouriteAsset;

    private Card $card;

    private Card $favouriteCard;

    protected function setUp(): void
    {
        parent::setUp();

        /** @var Language $language */
        $language = entity(Language::class)->create(['letter' => 'is']);

        $this->user           = entity(User::class)->create();
        $this->wordasset      = entity(WordAsset::class)->create(['user' => $this->user, 'language' => $language]);
        $this->favouriteAsset = entity(FavouriteAsset::class)->create(['user'     => $this->user,
                                                                       'language' => $language,
                                                                       'favorite' => 1,
        ]);

        entity(Passing::class)->create(['user' => $this->user, 'language' => $language, 'asset' => $this->wordasset]);
        entity(Passing::class)->create(['user'     => $this->user,
                                        'language' => $language,
                                        'asset'    => $this->favouriteAsset,
        ]);

        $this->card          = entity(Card::class)->create(['language' => $language, 'asset' => $this->wordasset]);
        $this->favouriteCard = entity(Card::class)->create(['language' => $language, 'asset' => $this->favouriteAsset]);
    }

    public function testIndex()
    {
        $response = $this->get('/');
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testGetUser()
    {
        $this->actingAs($this->user, 'api');

        $response = $this->get(route('user-info', ['domain' => 'is']));

        $response->assertJsonStructure(\Tests\Responses\User::singleResponse());
    }

    public function testInfo()
    {
        $this->actingAs($this->user, 'api');

        $response = $this->get(route('site-info', ['language' => 'is']));

        $response->assertJsonStructure(['site']);
    }

    //public function testSentences()
    //{
    //    $this->actingAs($this->user, 'api');

    //    $response = $this->get(route('sentences', ['language' => 'is']));

    //    $response->assertJsonStructure([['count', 'id', 'title', 'level', 'active', 'testlink', 'canopen', 'result', 'type', 'available']]);
    //}

    //public function testPersonal()
    //{
    //    $this->actingAs($this->user, 'api');

    //    $response = $this->get(route('personal', ['language' => 'is']));

    //    $response->assertJsonStructure([['count', 'id', 'title', 'level', 'result', 'type']]);
    //}

    //public function testCheck()
    //{
    //    $this->actingAs($this->user, 'api');

    //    $response = $this->get(route('state', ['language' => 'is']));
    //  //  dd($response);
    //    $response->assertJsonStructure(['auth', 'state' => ['user']]);

    //    $data = $response->decodeResponseJson();

    //    $this->assertEquals(1, $data['state']['user']['id']);
    //    $this->assertEquals(true, $data['auth']);
    //}

    //public function testCheckFail()
    //{
    //    $response = $this->get(route('state', ['language' => 'is']));

    //    $response->assertJsonStructure(['auth', 'state' => []]);

    //    $data = $response->decodeResponseJson();
    //    $this->assertEquals(false, $data['auth']);
    //}

    //public function testFeedback()
    //{
    //    $this->actingAs($this->user, 'api');

    //    $response = $this->post(route('subdomain-feedback', ['language' => 'is', 'message' => 'testmessage']));

    //    $this->assertEquals(201, $response->getStatusCode());

    //    $response->assertJsonStructure(['message', 'id']);

    //    $data = $response->decodeResponseJson();
    //    $this->assertEquals('testmessage', $data['message']);
    //    $this->assertEquals($this->user->getLogin(), $data['name']);
    //}

}