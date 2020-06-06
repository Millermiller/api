<?php


namespace App\Http\Controllers\Sub\Frontend;

use App\Helpers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Scandinaver\Common\Domain\Language;
use Scandinaver\Learn\Application\Commands\{AddCardToAssetCommand, DeleteCardFromAssetCommand};
use Scandinaver\Learn\Domain\{Asset, Card};
use Scandinaver\Learn\Domain\{Translate, Word};

/**
 * Class CardsController
 *
 * @package App\Http\Controllers\Sub\Frontend
 */
class CardsController extends Controller
{
    /**
     * @param Word      $word
     * @param Translate $translate
     * @param Asset     $asset
     *
     * @return JsonResponse
     */
    public function store(Word $word, Translate $translate, Asset $asset): JsonResponse
    {
        $this->commandBus->execute(new AddCardToAssetCommand(Auth::user(), $word, $translate, $asset));

        return response()->json(NULL, 201);
    }

    /**
     * @param Language $language
     * @param Card     $card
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function destroy(Language $language, Card $card): JsonResponse
    {
        $this->authorize('delete', $card);

        $this->commandBus->execute(new DeleteCardFromAssetCommand(Auth::user(), $card));

        return response()->json(NULL, 204);
    }
}