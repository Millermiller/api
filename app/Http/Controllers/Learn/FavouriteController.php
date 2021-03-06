<?php


namespace App\Http\Controllers\Learn;

use App\Helpers\Auth;
use App\Http\Controllers\Controller;
use Gate;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\JsonResponse;
use Scandinaver\Learn\Domain\Permission\Asset;
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
     * @param  int     $card
     *
     * @return JsonResponse
     * @throws AuthorizationException|BindingResolutionException
     */
    public function store(int $card): JsonResponse
    {
        Gate::authorize(Asset::CREATE_FAVOURITE, $card);

        $this->commandBus->execute(new CreateFavouriteCommand(Auth::user(), $card));

        return response()->json(NULL, 201);
    }

    /**
     * @param  int  $card
     *
     * @return JsonResponse
     * @throws AuthorizationException
     * @throws BindingResolutionException
     */
    public function destroy(int $card): JsonResponse
    {
        Gate::authorize(Asset::DELETE_FAVOURITE, $card);

        $this->commandBus->execute(new DeleteFavouriteCommand(Auth::user(), $card));

        return response()->json(NULL, 204);
    }

}