<?php

namespace App\Http\Controllers\Sub\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCardRequest;
use App\Models\Card;
use App\Models\Translate;
use App\Models\Word;
use App\Services\CardService;
use Auth;
use Illuminate\Support\Facades\Input;

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
    protected $cardService;

    public function __construct(CardService $cardService)
    {
        $this->cardService = $cardService;
    }

    public function store(CreateCardRequest $request)
    {
        $card = $this->cardService->create($request);

        return response()->json($card, 201);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $card = Card::findOrFail($id);

        $this->authorize('delete', $card);

        $card->forceDelete();

        return response()->json(null, 204);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function createCard()
    {
        $orig = Input::get('orig');
        $translate = Input::get('translate');
        $is_public = Input::get('is_public');

        $word = new Word([
            'word' => $orig,
            'sentence' => 0,
            'is_public' => $is_public,
            'creator' => Auth::user()->id,
            'lang' => config('app.lang')
        ]);

        if ($word->save())
            $translate = new Translate(['value' => $translate, 'sentence' => 0, 'word_id' => $word->id, 'is_public' => $is_public]);

        return response()->json([
            'success' => $translate->save(),
            'card' => [
                'value' => $translate->value,
                'translate_id' => $translate->id,
                'word' => $orig,
                'id' => $word->id,
                'creator' => Auth::user()->login,
            ]
        ]);
    }

    public function getSentences()
    {
       return response()->json(Word::getSentences());
    }
}