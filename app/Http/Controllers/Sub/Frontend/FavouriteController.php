<?php


namespace App\Http\Controllers\Sub\Frontend;

use App\Helpers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Scandinaver\Common\Domain\Language;
use Scandinaver\Learn\Application\Commands\{CreateFavouriteCommand, DeleteFavouriteCommand};
use Scandinaver\Learn\Domain\{Translate, Word};

/**
 * Class FavouriteController
 *
 * @package App\Http\Controllers\Sub\Frontend
 */
class FavouriteController extends Controller
{
    /**
     * @param Language  $language
     * @param Word      $word
     * @param Translate $translate
     *
     * @return JsonResponse
     */
    public function store(Language $language, Word $word, Translate $translate): JsonResponse
    {
        $this->commandBus->execute(new CreateFavouriteCommand($language, Auth::user(), $word, $translate));

        return response()->json(NULL, 201);
    }

    /**
     * @param Language $language
     * @param          $id
     *
     * @return JsonResponse
     */
    public function destroy(Language $language, $id): JsonResponse
    {
        $this->commandBus->execute(new DeleteFavouriteCommand($language, Auth::user(), $id));

        return response()->json(NULL, 204);
    }
}