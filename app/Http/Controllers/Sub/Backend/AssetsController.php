<?php

namespace App\Http\Controllers\Sub\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;
use PHPExcel_IOFactory;
use ReflectionException;
use Scandinaver\Learn\Application\Query\FindAudioQuery;
use Scandinaver\Learn\Domain\Word;
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
     * @return JsonResponse
     */
    public function index()
    {
        return response()->json([
            'words' => array_values(Asset::domain()->withCount('cards')
                ->where('basic', '=', '1')
                ->where('type', '=', Asset::TYPE_WORDS)
                ->get()
                ->sortBy('level')
                ->toArray()
            ),
            'sentences' => array_values(Asset::domain()->withCount('cards')
                ->where('basic', '=', '1')
                ->where('type', '=', Asset::TYPE_SENTENCES)
                ->get()
                ->sortBy('level')
                ->toArray()
            )
        ]);
    }

    /**
     * @param Word $word
     * @return JsonResponse
     * @throws ReflectionException
     */
    public function findAudio(Word $word)
    {
        return response()->json($this->queryBus->execute(new FindAudioQuery($word)));
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
        return response()->json(['success' => true, 'msg' => Asset::addLevel($asset_id)]);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function deleteTranslate($id)
    {
        Card::where('word_id', '=', $id)->delete();

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
     * @throws \PHPExcel_Reader_Exception
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
            'success' => Asset::find($id)->update(['title' => Input::get('text'), 'level' => Input::get('level')])
        ]);
    }
}