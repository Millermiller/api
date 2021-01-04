<?php

namespace Tests\Feature\Controllers\Learn;

use Exception;
use Scandinaver\RBAC\Domain\Model\Permission;
use App\Http\Controllers\Learn\FavouriteController;
use Tests\TestCase;
use Scandinaver\Common\Domain\Model\Language;
use Scandinaver\Learn\Domain\Model\Card;
use Scandinaver\Learn\Domain\Model\FavouriteAsset;
use Scandinaver\Learn\Domain\Model\Result;
use Scandinaver\Learn\Domain\Model\WordAsset;
use Scandinaver\User\Domain\Model\User;

class FavouriteControllerTest extends TestCase
{
    private User $user;

    private WordAsset $wordasset;

    private FavouriteAsset $favouriteAsset;

    private Card $card;

    private Card $favouriteCard;

    protected function setUp(): void
    {
        parent::setUp();

        /** @var Language $language */
        $language = entity(Language::class)->create(['name' => 'is']);

        $this->user           = entity(User::class)->create();
        $this->wordasset      = entity(WordAsset::class)->create(['user' => $this->user, 'language' => $language]);
        $this->favouriteAsset = entity(FavouriteAsset::class)->create(['user' => $this->user, 'language' => $language, 'favorite' => 1]);

        $result = entity(Result::class)->create(['user' => $this->user, 'language' => $language, 'asset' => $this->wordasset]);
        $this->user->addTest($result);
        $result = entity(Result::class)->create(['user' => $this->user, 'language' => $language, 'asset' =>  $this->favouriteAsset]);
        $this->user->addTest($result);

        $this->card = entity(Card::class)->create(['language' => $language, 'asset' => $this->wordasset ]);
        $this->favouriteCard = entity(Card::class)->create(['language' => $language, 'asset' => $this->favouriteAsset ]);
    }

    /**
     * @throws Exception
     */
    public function testDestroy()
    {
        $permission = new Permission(\Scandinaver\Learn\Domain\Permissions\Asset::DELETE_FAVOURITE);
        $this->user->allow($permission);

        $this->actingAs($this->user, 'api');

        $response = $this->delete(route('delete-favorite', [
            'language' => 'is', 'card' => $this->favouriteCard->getId()
        ]));

        static::assertEquals(204, $response->getStatusCode());
    }

    public function testStore()
    {
        $permission = new Permission(\Scandinaver\Learn\Domain\Permissions\Asset::CREATE_FAVOURITE);
        $this->user->allow($permission);

        $this->actingAs($this->user, 'api');

        $response = $this->post(
            route(
                'add-favorite',
                ['language' => 'is', 'card' => $this->card->getId()]
            )
        );

        static::assertEquals(201, $response->getStatusCode());
    }
}
