<?php

namespace App\Http\Controllers\Sub\Backend;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Models\Card;
use App\Models\Example;
use App\Models\Translate;
use App\Models\Word;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;
use PHPExcel_IOFactory;
use Sunra\PhpSimple\HtmlDomParser;
use Upload\File;
use Upload\Storage\FileSystem;

/**
 * Created by PhpStorm.
 * User: john
 * Date: 30.08.2017
 * Time: 20:29
 *
 * Class AssetsController
 * @package Application\Controllers\Admin
 */
class AssetsController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json([
            'words' => array_values(Asset::withCount('cards')
                ->where('basic', '=', '1')
                ->where('type', '=', Asset::TYPE_WORDS)
                ->get()
                ->sortBy('level')
                ->toArray()
            ),
            'sentences' => array_values(Asset::withCount('cards')
                ->where('basic', '=', '1')
                ->where('type', '=', Asset::TYPE_SENTENCES)
                ->get()
                ->sortBy('level')
                ->toArray()
            )
        ]);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function findAudio($id)
    {
        $cards = Card::with('word')->where('asset_id', '=', $id)->get();

        $count = 0;
        foreach ($cards as $card) { //TODO: жесть

            $html = @file_get_contents('http://forvo.com/word/' . $card->word->word . '/#' . env('SHORTLANG'));

            $dom = HtmlDomParser::str_get_html($html);

            $onclick = $dom->find('em[id=is]')[0]->parent()->next_sibling()->find('li')[0]->first_child()->onclick;

            if (!$onclick) continue;

            $arr = explode("'", $onclick);

            $link = (isset($arr[1])) ? $arr[1] : null;

            if (!$link) continue;

            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, 'https://forvo.com/player-mp3Handler.php?path=' . $link);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            //curl_setopt($curl, CURLOPT_COOKIEFILE, BASE_URL . '/temp/cookie.txt');
            $file = curl_exec($curl);
            curl_close($curl);

            $filename = Str::random(32);

            touch(public_path() . '/audio/' . $filename . '.mp3');
            $fp = fopen(public_path() . '/audio/' . $filename . '.mp3', 'w');
            $filesize = fwrite($fp, $file);
            fclose($fp);

            if ($filesize > 0) {
                Word::find($card->word->id)->update(['audio' => '/audio/' . $filename . '.mp3']);
                $count++;
            }
        }

        return response()->json([
            'success' => true,
            'count' => $count,
            'all' => count($cards)
        ]);

    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function showAsset($id)
    {
        return response()->json([
            'success' => true,
            'data' => Asset::with('cards', 'cards.word', 'cards.translate')->where('id', '=', $id)->first()
        ]);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function showValues($id)
    {
        return response()->json(['success' => true, 'values' => Translate::where('word_id', '=', $id)->get()]);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function showExamples($id)
    {
        return response()->json(['success' => true, 'values' => Example::where('card_id', '=', $id)->get()]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function changeUsedTranslate()
    {

        $word_id = Input::get('word_id');
        $card_id = Input::get('card_id');
        $translate_id = Input::get('translate_id');

        if (Card::find($card_id)->update(['word_id' => $word_id, 'translate_id' => $translate_id]))
            return response()->json(['success' => true]);
        else
            return response()->json(['success' => false]);

    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function editTranslate()
    {
        $translate_id = Input::get('id');
        $text = Input::get('text');

        Translate::find($translate_id)->update(['value' => $text]);

        Example::where('card_id', '=', Input::get('card_id'))->forceDelete();

        if (Input::get('examples')) {
            foreach (Input::get('examples') as $example) {
                Example::create([
                    'card_id' => Input::get('card_id'),
                    'text' => $example['text'],
                    'value' => $example['value'],
                ]);
            }
        }

        return response()->json(['success' => true]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function uploadAudio()
    {
        $id = $_REQUEST['id'];
        $storage = new FileSystem(public_path() . '/audio/');
        $file = new File('audiofile', $storage);
        $new_filename = uniqid();
        $file->setName($new_filename);

        try {
            $file->upload();
            $url = '/audio/' . $file->getNameWithExtension();
            Word::find($id)->update(['audio' => $url]);
            return response()->json(['success' => true, 'url' => $url]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'msg' => $e->getMessage()]);
        }
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getSentences()
    {
        return response()->json(Word::getSentences());
    }

    /**
     *добавить новый набор
     */
    public function addBasicAssetLevel()
    {
        $asset_id = Input::get('asset_id');
        return response()->json(['success' => true, 'msg' => Card::addLevel($asset_id)]);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteTranslate($id)
    {
        if (Word::destroy($id))
            return response()->json(['success' => Translate::where('word_id', '=', $id)->delete()]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function addPair()
    {

        $word = Input::get('word');
        $translate = Input::get('translate');
        $issentence = Input::get('issentence');

        $word = new Word(['word' => $word, 'sentence' => $issentence]);

        if ($word->save())
            $translate = new Translate(['value' => $translate, 'sentence' => $issentence, 'word_id' => $word->id]);

        return response()->json(['success' => $translate->save()]);

    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function uploadSentences()
    {
        $storage = new FileSystem(public_path() . '/files/');
        $file = new File('file', $storage);
        $new_filename = uniqid();
        $file->setName($new_filename);

        try {
            $file->upload();
            $this->parseSentense(public_path() . '/files/' . $file->getNameWithExtension());
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    /**
     * @param $file
     * @return \Illuminate\Http\JsonResponse
     */
    protected function parseSentense($file)
    {
        $objPHPExcel = PHPExcel_IOFactory::load($file);
        $ar = $objPHPExcel->getActiveSheet()->toArray();
        $i = 0;

        foreach ($ar as $sentence) {
            $orig = $sentence[0];
            $translate = $sentence[1];

            $word = new Word(['word' => $orig, 'sentence' => 1]);

            if ($word->save()) {
                $translate = new Translate(['value' => $translate, 'sentence' => 1, 'word_id' => $word->id]);
                $translate->save();
                $i++;
            }
        }

        return response()->json(['success' => true, 'count' => $i]);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function changeAsset($id)
    {
        return response()->json([
            'success' => Asset::find($id)->update(['title' => Input::get('text')])
        ]);
    }
}