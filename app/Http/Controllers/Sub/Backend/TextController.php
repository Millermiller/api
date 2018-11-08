<?php

namespace App\Http\Controllers\Sub\Backend;

use App\Http\Controllers\Controller;
use App\Models\Synonym;
use App\Models\Text;
use App\Models\TextExtra;
use App\Models\TextWord;
use Illuminate\Support\Facades\Input;
use Intervention\Image\ImageManagerStatic as Image;
use Upload\File;
use Upload\Storage\FileSystem;
use Upload\Validation\Mimetype;
use Upload\Validation\Size;

/**
 * Created by PhpStorm.
 * User: john
 * Date: 30.08.2017
 * Time: 20:39
 *
 * Class TextController
 * @package Application\Controllers\Admin
 */
class TextController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json(Text::all()->sortBy('id'));
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function publish()
    {
        $publish = (int)Input::get('published');
        $id = Input::get('id');

        $result = Text::find($id)->update(['published' => $publish]);

        return response()->json(['success' => $result]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function textcreate()
    {
        $title = $this->cleartext(Input::get('title'));
        $origtext = $this->cleartext(Input::get('origtext'));
        $translate = $this->cleartext(Input::get('translate'));

        $text = Text::create(['title' => $title, 'text' => $origtext, 'translate' => $translate]);

        $sentences = explode('.', trim($translate));
        array_pop($sentences);

        foreach ($sentences as $num => $sentence) {
            $words = explode(' ', str_replace(',', '', trim($sentence)));
            $sentences[$num] = $words;
        }

        foreach ($sentences as $num => $sentence) {
            foreach ($sentence as $word) {
                TextWord::create(['text_id' => $text->id, 'sentence_num' => $num, 'word' => $word]);
            }
        }

        return response()->json(['success' => true, 'id' => $text->id]);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function textdelete($id)
    {
        try {
            /** @var Text $text */
            $text = Text::findOrFail($id);
            $text->result()->delete();
            return response()->json(['success' => $text->delete()]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'msg' => $e->getMessage()]);

        }
    }

    public function textedit()
    {

    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getText($id)
    {
        $sentences = [];
        $extras = TextExtra::where('text_id', '=', $id)->get();
        $synonims = Text::getSynonyms($id);
        $text = Text::withCount('words')->find($id)->makeVisible('translate');
        $cleartext = $text->text;

        foreach ($extras as $extra) {
            $text->text = str_replace($extra['orig'],
                '<a href="#" class="tooltip-extra text-success" rel="tooltip" data-id="' . $extra['id'] . '" data-placement="top" data-original-title="' . $extra['extra'] . '">' . $extra['orig'] . '</a>',
                $text->text);
        }

        $words = TextWord::where('text_id', '=', $id)->orderBy('id', 'ASC')->get();

        foreach ($words as $w)
            $sentences[$w['sentence_num']][] = $w;


        return response()->json([
            'text' => $text,
            'cleartext' => $cleartext,
            'sentences' => $sentences,
            'extras' => $extras,
            'synonyms' => $synonims,
            'success' => true,
        ]);

    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function addExtras()
    {
        $data = Input::get('data');

        $textid = trim(Input::get('text_id'));

        TextExtra::where('text_id', $textid)->delete();

        foreach ($data as $extra) {
            $textExtra = new TextExtra(
                [
                    'text_id' => $textid,
                    'orig' => trim($extra['orig']),
                    'extra' => trim($extra['extra'])
                ]
            );
        }
        return response()->json(['success' => true]);

    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function saveSentences()
    {
        $data = Input::get('data');
        $textId = Input::get('text_id');

        TextWord::where('text_id', $textId)->delete();

        foreach ($data as $sentence) {
            foreach ($sentence as $word) {
                $model = new TextWord([
                    'text_id' => $word['text_id'],
                    'word' => $word['word'],
                    'orig' => $word['orig'],
                    'sentence_num' => $word['sentence_num']
                ]);
            }
        }
        return response()->json(['success' => true]);

    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getSynonyms($id)
    {
        return response()->json([
            'success' => true,
            'synonyms' => Synonym::where('word_id', $id)->get()
        ]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function addSynonym()
    {
        $word_id = Input::get('word_id');
        $synonym = Input::get('synonym');

        return response()->json(['success' => Synonym::create(['word_id' => $word_id, 'synonym' => $synonym])]);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteSynonym($id)
    {
        return response()->json(['success' => Synonym::destroy($id)]);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function uploadImage($id)
    {
        $storage = new FileSystem(public_path() . '/uploads/photo/');
        $file = new File('file', $storage);
        $new_filename = uniqid();
        $file->setName($new_filename);
        $file->addValidations(array(
            new Mimetype(array('image/png', 'image/jpg', 'image/jpeg')),
            new Size('5M')
        ));

        try {
            $file->upload();
            $url = '/uploads/photo/' . $file->getNameWithExtension();

            // Image::configure(array('driver' => 'GD'));
            $img = Image::make(public_path() . $url);

            if ($img->getWidth() > 1000)
                $img->widen(600);

            if ($img->getHeight() > 1000)
                $img->heighten(600);

            $img->save(null, 100);

            $thumb = Image::make(public_path() . $url);
            $thumb->widen(150);
            $thumb->save(public_path() . '/uploads/thumbs/' . $file->getNameWithExtension());

            $text = Text::find($id);
            $text->image = '/uploads/photo/' . $file->getNameWithExtension();
            return response()->json(['success'=> $text->save()]);

        } catch (\Exception $e) {
            $errors = $file->getErrors();
            $message = implode(', ', $errors);
            return response()->json([
                'msg' => $message,
                'success' => false,
                'mess' => $e->getMessage(),
            ]);
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateDescription($id)
    {
        return response()->json(['success' => Text::updateOrCreate(['id' => $id], ['description' => Input::get('content')])]);
    }

    /**
     * @param $text
     * @return mixed
     */
    protected function cleartext($text)
    {
        return str_replace(array("\r\n", "\r", "\n"), '', strip_tags(trim($text)));
    }
}