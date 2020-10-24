<?php


namespace App\Http\Controllers\Learn;

use App\Helpers\Auth;
use App\Http\Controllers\Controller;
use Gate;
use Illuminate\Http\JsonResponse;
use Scandinaver\Common\Domain\Model\Language;
use Scandinaver\Learn\UI\Command\CreateFavouriteCommand;
use Scandinaver\Learn\UI\Command\DeleteFavouriteCommand;
use Scandinaver\Learn\Domain\Model\{Card};

/**
 * Class FavouriteController
 *
 * @package App\Http\Controllers\Learn
 */
class FavouriteController extends Controller
{
    public function store(string $language, int $card): JsonResponse
    {
        Gate::authorize('create-favourite', $card);

        $this->commandBus->execute(new CreateFavouriteCommand($language, Auth::user(), $card));

        return response()->json(NULL, 201);
    }

    public function destroy(string $language, int $card): JsonResponse
    {
        Gate::authorize('delete-favourite', $card);

        $this->commandBus->execute(new DeleteFavouriteCommand($language, Auth::user(), $card));

        return response()->json(NULL, 204);
    }
}