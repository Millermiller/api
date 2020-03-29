<?php


namespace App\Http\Controllers\Sub\Frontend;

use App\Helpers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use ReflectionException;
use Scandinaver\Learn\Application\Commands\{CreateFavouriteCommand, DeleteFavouriteCommand};
use Scandinaver\Common\Domain\Language;
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
     * @throws ReflectionException
     */
    public function store(Language $language, Word $word, Translate $translate): JsonResponse
    {
        $this->commandBus->execute(new CreateFavouriteCommand($language, Auth::user(), $word, $translate));

        return response()->json(null, 201);
    }

    /**
     * @param $id
     *
     * @return JsonResponse
     * @throws ReflectionException
     */
    public function destroy($id): JsonResponse
    {
        $this->commandBus->execute(new DeleteFavouriteCommand(Auth::user(), $id));

        return response()->json(null, 204);
    }
}