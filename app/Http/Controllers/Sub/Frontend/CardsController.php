<?php

namespace App\Http\Controllers\Sub\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCardRequest;
use App\Entities\Card;
use App\Models\Word;
use App\Services\CardService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;

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
     * @var CardService
     */
    protected $cardService;

    /**
     * CardsController constructor.
     * @param CardService $cardService
     */
    public function __construct(CardService $cardService)
    {
        $this->cardService = $cardService;
    }

    /**
     * @param CreateCardRequest $request
     * @return JsonResponse
     */
    public function store(CreateCardRequest $request)
    {
        $card = $this->cardService->createCard($request->toArray());

        return response()->json($card, 201);
    }

    /**
     * @param Card $card
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function destroy(Card $card)
    {
        $this->authorize('delete', $card);

        $this->cardService->destroyCard($card);

        return response()->json(null, 204);
    }

    public function getSentences()
    {
       return response()->json(Word::getSentences());
    }
}