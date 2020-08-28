<?php


namespace App\Http\Controllers\Sub\Frontend;

use App\Helpers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Scandinaver\Common\Domain\Model\Language;
use Scandinaver\Learn\UI\Command\CreateFavouriteCommand;
use Scandinaver\Learn\UI\Command\DeleteFavouriteCommand;
use Scandinaver\Learn\Domain\Model\{Card, Translate, Word};

/**
 * Class FavouriteController
 *
 * @package App\Http\Controllers\Sub\Frontend
 */
class FavouriteController extends Controller
{
    public function store(Language $language, Card $card): JsonResponse
    {
        $this->commandBus->execute(new CreateFavouriteCommand($language, Auth::user(), $card));

        return response()->json(NULL, 201);
    }

    public function destroy(Language $language, Card $card): JsonResponse
    {
        $this->commandBus->execute(new DeleteFavouriteCommand($language, Auth::user(), $card));

        return response()->json(NULL, 204);
    }
}