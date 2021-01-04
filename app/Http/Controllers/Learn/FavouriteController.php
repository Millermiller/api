<?php


namespace App\Http\Controllers\Learn;

use Gate;
use App\Helpers\Auth;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Scandinaver\Learn\Domain\Permissions\Asset;
use Illuminate\Auth\Access\AuthorizationException;
use Scandinaver\Learn\UI\Command\CreateFavouriteCommand;
use Scandinaver\Learn\UI\Command\DeleteFavouriteCommand;

/**
 * Class FavouriteController
 *
 * @package App\Http\Controllers\Learn
 */
class FavouriteController extends Controller
{

    /**
     * @param  string  $language
     * @param  int     $card
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function store(string $language, int $card): JsonResponse
    {
        Gate::authorize(Asset::CREATE_FAVOURITE, $card);

        $this->commandBus->execute(new CreateFavouriteCommand($language, Auth::user(), $card));

        return response()->json(null, 201);
    }

    /**
     * @param  string  $language
     * @param  int     $card
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function destroy(string $language, int $card): JsonResponse
    {
        Gate::authorize(Asset::DELETE_FAVOURITE, $card);

        $this->commandBus->execute(new DeleteFavouriteCommand($language, Auth::user(), $card));

        return response()->json(null, 204);
    }

}