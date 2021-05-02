<?php

namespace Tests\Feature\Controllers\Learn;

use Exception;
use Scandinaver\RBAC\Domain\Model\Permission;
use App\Http\Controllers\Learn\FavouriteController;
use Tests\TestCase;
use Scandinaver\Common\Domain\Model\Language;
use Scandinaver\Learn\Domain\Model\Card;
use Scandinaver\Learn\Domain\Model\FavouriteAsset;
use Scandinaver\Learn\Domain\Model\Passing;
use Scandinaver\Learn\Domain\Model\WordAsset;
use Scandinaver\User\Domain\Model\User;

class FavouriteControllerTest extends TestCase
{
    private User $user;

    private WordAsset $wordasset;

    private FavouriteAsset $favouriteAsset;

    private Card $card;

    private Card $favouriteCard;

    /**
     * @throws Exception
     */
    protected function setUp(): void
    {
        parent::setUp();

        /** @var Language $language */
        $language = entity(Language::class)->create(['name' => 'is']);

        $this->user           = entity(User::class)->create();
        $this->wordasset      = entity(WordAsset::class)->create(['user' => $this->user, 'language' => $language]);
        $this->favouriteAsset = entity(FavouriteAsset::class)->create(['user' => $this->user, 'language' => $language, 'favorite' => 1]);

        $passing = entity(Passing::class)->create(['user' => $this->user, 'language' => $language, 'asset' => $this->wordasset]);
        $this->user->addPassing($passing);
        $passing = entity(Passing::class)->create(['user' => $this->user, 'language' => $language, 'asset' =>  $this->favouriteAsset]);
        $this->user->addPassing($passing);

        $this->card = entity(Card::class)->create(['language' => $language, 'asset' => $this->wordasset ]);
        $this->favouriteCard = entity(Card::class)->create(['language' => $language, 'asset' => $this->favouriteAsset ]);

        $this->favouriteAsset->setOwner($this->user);
        $this->user->addPersonalAsset($this->favouriteAsset);
    }

    /**
     * @throws Exception
     */
    public function testDestroy()
    {
        $permission = new Permission(\Scandinaver\Learn\Domain\Permission\Asset::DELETE_FAVOURITE);
        $this->user->allow($permission);

        $this->actingAs($this->user, 'api');

        $response = $this->delete(route('favourite:remove', [
            'card' => $this->favouriteCard->getId()
        ]));
        $response = $response;
        static::assertEquals(204, $response->getStatusCode());
    }

    public function testStore()
    {
        $permission = new Permission(\Scandinaver\Learn\Domain\Permission\Asset::CREATE_FAVOURITE);
        $this->user->allow($permission);

        $this->actingAs($this->user, 'api');

        $response = $this->post(
            route(
                'favourite:add',
                ['card' => $this->card->getId()]
            )
        );

        static::assertEquals(201, $response->getStatusCode());
    }
}
