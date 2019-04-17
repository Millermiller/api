<?php

namespace App\Http\Controllers\Sub\Frontend;

use App\Events\AssetCreated;
use App\Events\AssetDelete;
use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Models\Card;
use App\Models\Result;
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

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function showAsset($id)
    {
        $asset = $this->cardService->getCards($id);

        return response()->json($asset);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function createCard()
    {
        $orig = Input::get('orig');
        $translate = Input::get('translate');
        $is_public = Input::get('is_public');

        $word = new Word(['word' => $orig, 'sentence' => 0, 'is_public' => $is_public, 'creator' => Auth::user()->id, 'lang' => config('app.lang')]);

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

    public function addWordToAsset()
    {
        $word_id = Input::get('word_id');
        $asset_id = Input::get('asset_id');
        $translate_id = Input::get('translate_id');

        $card = new Card([
            'asset_id' => $asset_id,
            'word_id' => $word_id,
            'translate_id' => $translate_id
        ]);

        if ($card->save()) {
            return response()->json([
                'success' => true,
                'card' => [
                    'asset_id' => $card->asset->id,
                    'audio' => $card->word->audio,
                    'favorite' => $card->asset->favorite,
                    'id' => $card->id,
                    'translate_id' => $card->translate_id,
                    'translate' => $card->translate,
                    'value' => $card->translate->value,
                    'word' => $card->word,
                    'word_id' => $card->word->id
                ]
            ]);
        }
    }

    /**
     * @param $id
     * @param $asset_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteWordFromAsset($id, $asset_id)
    {
        $this->cardService->delete($id, $asset_id);

        return response()->json(null, 204);
    }

    public function getTranslate()
    {
        $word = Input::get('word');
        $translate = Word::translate($word, intval(Input::get('sentence')));

        if (count($translate) == 0)
            return response()->json(['success' => false, 'message' => "Ничего не найдено"]);
        else
            return response()->json(['success' => true, 'translate' => $translate]);
    }

    public function getSentences()
    {
       return response()->json(Word::getSentences());
    }
}