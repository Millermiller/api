<?php

namespace App\Http\Controllers\Sub\Frontend;

use App\Events\AssetCreated;
use App\Events\AssetDelete;
use App\Http\Controllers\Controller;
use App\Models\Card;
use App\Models\Translate;
use App\Models\Word;
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

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function showAsset($id)
    {
        return response()->json(Card::getCards($id));
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function createCard()
    {
        $orig = Input::get('orig');
        $translate = Input::get('translate');
        $is_public = Input::get('is_public');

        $word = new Word(['word' => $orig, 'sentence' => 0, 'is_public' => $is_public, 'creator' => Auth::user()->login]);

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

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function createAsset()
    {
        $asset_title = Input::get('title');

        $asset = Card::createAsset(Auth::user()->id, $asset_title);

        event(new AssetCreated($asset));

        return response()->json(['success' => true, 'id' => $asset->id, 'title' => $asset->title]);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteAsset($id)
    {
        event(new AssetDelete($id));

        return response()->json(['success' => Card::deleteAsset($id)]);
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
       if (!Auth::user()->hasAsset($asset_id) && !Auth::user()->_admin)
           return response()->json(['success'=> false]);
       else
           return response()->json(['success'=> Card::whereRaw('id = ? and asset_id = ?', [$id, $asset_id])->forceDelete()]);

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