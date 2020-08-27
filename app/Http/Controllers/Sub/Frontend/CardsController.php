<?php


namespace App\Http\Controllers\Sub\Frontend;

use App\Helpers\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCardRequest;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Scandinaver\Common\Domain\Model\Language;
use Scandinaver\Learn\Domain\Model\{Asset, Card};
use Scandinaver\Learn\UI\Command\AddCardToAssetCommand;
use Scandinaver\Learn\UI\Command\CreateCardCommand;
use Scandinaver\Learn\UI\Command\DeleteCardFromAssetCommand;
use Scandinaver\Learn\Domain\Model\{Translate, Word};

/**
 * Class CardsController
 *
 * @package App\Http\Controllers\Sub\Frontend
 */
class CardsController extends Controller
{
    public function store(Language $language, Card $card, Asset $asset): JsonResponse
    {
        $this->commandBus->execute(new AddCardToAssetCommand(Auth::user(), $language, $card, $asset));

        return response()->json(NULL, 201);
    }

    public function create(Language $language, CreateCardRequest $request): JsonResponse
    {
        $card = $this->commandBus->execute(new CreateCardCommand(
            Auth::user(), $language, $request->get('word'), $request->get('translate')
        ));

        return response()->json($card, 201);
    }

    /**
     * @param  Language  $language
     * @param  Card      $card
     * @param  Asset     $asset
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function destroy(Language $language, Card $card, Asset $asset): JsonResponse
    {
        $this->authorize('delete', [$card, $asset]);

        $this->commandBus->execute(new DeleteCardFromAssetCommand(Auth::user(), $card, $asset));

        return response()->json(NULL, 204);
    }
}