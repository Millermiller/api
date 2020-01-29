<?php

namespace App\Http\Controllers\Sub\Frontend;

use ReflectionException;
use App\Helpers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Auth\Access\AuthorizationException;
use Scandinaver\Learn\Application\Commands\{AddCardToAssetCommand, DeleteCardFromAssetCommand};
use Scandinaver\Learn\Domain\{Asset, Card};
use Scandinaver\Learn\Domain\{Translate, Word};

/**
 * Created by PhpStorm.
 * User: whiskey
 * Date: 07.02.15
 * Time: 4:22
 *
 * Class CardsController
 * @package  App\Http\Controllers\Sub\Frontend
 */
class CardsController extends Controller
{
    /**
     * @param Word $word
     * @param Translate $translate
     * @param Asset $asset
     * @return JsonResponse
     * @throws ReflectionException
     */
    public function store(Word $word, Translate $translate, Asset $asset)
    {
        $this->commandBus->execute(new AddCardToAssetCommand(Auth::user(), $word, $translate, $asset));

        return response()->json(null, 201);
    }

    /**
     * @param Card $card
     * @return JsonResponse
     * @throws AuthorizationException
     * @throws ReflectionException
     */
    public function destroy(Card $card)
    {
        $this->authorize('delete', $card);

        $this->commandBus->execute(new DeleteCardFromAssetCommand(Auth::user(), $card));

        return response()->json(null, 204);
    }
}