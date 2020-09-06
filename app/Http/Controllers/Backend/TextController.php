<?php


namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use Scandinaver\Common\Domain\Model\Language;
use Scandinaver\Translate\Domain\Model\Synonym;
use Scandinaver\Translate\Domain\Model\Text;
use Scandinaver\Translate\Domain\Model\Word;
use Scandinaver\Translate\UI\Command\CreateSynonymCommand;
use Scandinaver\Translate\UI\Command\CreateTextCommand;
use Scandinaver\Translate\UI\Command\CreateTextExtraCommand;
use Scandinaver\Translate\UI\Command\DeleteSynonymCommand;
use Scandinaver\Translate\UI\Command\DeleteTextCommand;
use Scandinaver\Translate\UI\Command\PublishTextCommand;
use Scandinaver\Translate\UI\Command\UpdateDescriptionCommand;
use Scandinaver\Translate\UI\Query\GetSynonymsQuery;
use Scandinaver\Translate\UI\Query\GetTextQuery;
use Scandinaver\Translate\UI\Query\GetTextsQuery;
use Upload\File;
use Upload\Storage\FileSystem;
use Upload\Validation\Mimetype;
use Upload\Validation\Size;

/**
 * Created by PhpStorm.
 * User: john
 * Date: 30.08.2017
 * Time: 20:39
 * Class TextController
 *
 * @package Application\Controllers\Admin
 */
class TextController extends Controller
{

    /**
     * @param  Language  $language
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function all(Language $language): JsonResponse
    {
        $this->authorize('all', Text::class);

        return response()->json($this->queryBus->execute(new GetTextsQuery($language)));
    }

    /**
     * @param  Text  $text
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function view(Text $text): JsonResponse
    {
        $this->authorize('view', $text);

        return response()->json($this->queryBus->execute(new GetTextQuery($text)));

        // $sentences = [];
        // $extras    = TextExtra::where('text_id', '=', $id)->get();
        // $synonims  = Text::getSynonyms($id);
        // $text      = Text::withCount('words')->find($id)->makeVisible('translate');
        // $cleartext = $text->text;
        // foreach ($extras as $extra) {
        //     $text->text = str_replace($extra['orig'],
        //         '<a href="#" class="tooltip-extra text-success" rel="tooltip" data-id="' . $extra['id'] . '" data-placement="top" data-original-title="' . $extra['extra'] . '">' . $extra['orig'] . '</a>',
        //         $text->text);
        // }
        // $words = TextWord::where('text_id', '=', $id)->orderBy('id', 'ASC')->get();
        // foreach ($words as $w){
        //     $sentences[$w['sentence_num']][] = $w;
        // }
        // return response()->json([
        //     'text'      => $text,
        //     'cleartext' => $cleartext,
        //     'sentences' => $sentences,
        //     'extras'    => $extras,
        //     'synonyms'  => $synonims,
        //     'success'   => true,
        // ]);
    }

    /**
     * @param  Request  $request
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function store(Request $request): JsonResponse
    {
        $this->authorize('create', Text::class);

        return response()->json($this->commandBus->execute(new CreateTextCommand()));

        // $title     = $this->cleartext(Input::get('title'));
        // $origtext  = $this->cleartext(Input::get('origtext'));
        // $translate = $this->cleartext(Input::get('translate'));
        // $text = Text::create(['title' => $title, 'text' => $origtext, 'translate' => $translate]);
        // $sentences = explode('.', trim($translate));
        // array_pop($sentences);
        // foreach ($sentences as $num => $sentence) {
        //     $words           = explode(' ', str_replace(',', '', trim($sentence)));
        //     $sentences[$num] = $words;
        // }
        // foreach ($sentences as $num => $sentence) {
        //     foreach ($sentence as $word) {
        //         TextWord::create(['text_id' => $text->id, 'sentence_num' => $num, 'word' => $word]);
        //     }
        // }
        // return response()->json(['success' => true, 'id' => $text->id]);
    }

    /**
     * @param  Text  $text
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function publish(Text $text): JsonResponse
    {
        $this->authorize('update', $text);

        return $this->commandBus->execute(new PublishTextCommand($text));

        // $publish = (int)Input::get('published');
        // $id      = Input::get('id');
        // $result = Text::find($id)->update(['published' => $publish]);
        // return response()->json(['success' => $result]);
    }

    /**
     * @param  Text  $text
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function destroy(Text $text): JsonResponse
    {
        $this->authorize('delete', $text);

        return $this->commandBus->execute(new DeleteTextCommand($text));

        // try {
        //     /** @var Text $text */
        //     $text = Text::findOrFail($id);
        //     $text->result()->delete();
        //     return response()->json(['success' => $text->delete()]);
        // } catch (\Exception $e) {
        //     return response()->json(['success' => false, 'msg' => $e->getMessage()]);
        // }
    }

    public function update(Text $text)
    {

    }

    /**
     * @param  Text     $text
     * @param  Request  $request
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function addExtras(Text $text, Request $request): JsonResponse
    {
        $this->authorize('update', $text);

        return $this->commandBus->execute(new CreateTextExtraCommand());

        // $data = Input::get('data');
        // $textid = trim(Input::get('text_id'));
        // TextExtra::where('text_id', $textid)->delete();
        // foreach ($data as $extra) {
        //     $textExtra = new TextExtra(
        //         [
        //             'text_id' => $textid,
        //             'orig'    => trim($extra['orig']),
        //             'extra'   => trim($extra['extra'])
        //         ]
        //     );
        // }
        // return response()->json(['success' => true]);
    }

    /**
     * @param  Text     $text
     * @param  Request  $request
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function saveSentences(Text $text, Request $request): JsonResponse
    {
        $this->authorize('update', $text);

        // $data   = Input::get('data');
        // $textId = Input::get('text_id');
        // TextWord::where('text_id', $textId)->delete();
        // foreach ($data as $sentence) {
        //     foreach ($sentence as $word) {
        //         $model = new TextWord([
        //             'text_id'      => $word['text_id'],
        //             'word'         => $word['word'],
        //             'orig'         => $word['orig'],
        //             'sentence_num' => $word['sentence_num']
        //         ]);
        //     }
        // }
        // return response()->json(['success' => true]);
    }

    public function getSynonyms(Word $word): JsonResponse
    {
        return $this->queryBus->execute(new GetSynonymsQuery($word));

        //return response()->json([
        //    'success'  => true,
        //    'synonyms' => Synonym::where('word_id', $id)->get()
        //]);
    }

    /**
     * @param  Request  $request
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function addSynonym(Request $request): JsonResponse
    {
        $this->authorize('update', Text::class);

        return $this->commandBus->execute(new CreateSynonymCommand($request));

        // $word_id = Input::get('word_id');
        // $synonym = Input::get('synonym');
        // return response()->json(['success' => Synonym::create(['word_id' => $word_id, 'synonym' => $synonym])]);
    }

    /**
     * @param  Synonym  $synonym
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function deleteSynonym(Synonym $synonym): JsonResponse
    {
        $this->authorize('update', Text::class);

        return $this->commandBus->execute(new DeleteSynonymCommand($synonym));

        // return response()->json(['success' => Synonym::destroy($id)]);
    }

    /**
     * @param $id
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function uploadImage($id): JsonResponse
    {
        $this->authorize('update', Text::class);

        $storage      = new FileSystem(public_path() . '/uploads/photo/');
        $file         = new File('file', $storage);
        $new_filename = uniqid();
        $file->setName($new_filename);
        $file->addValidations([
            new Mimetype(['image/png', 'image/jpg', 'image/jpeg']),
            new Size('5M')
        ]);
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

            $text        = Text::find($id);
            $text->image = '/uploads/photo/' . $file->getNameWithExtension();
            return response()->json(['success' => $text->save()]);

        } catch (\Exception $e) {
            $errors  = $file->getErrors();
            $message = implode(', ', $errors);
            return response()->json([
                'msg'     => $message,
                'success' => false,
                'mess'    => $e->getMessage(),
            ]);
        }
    }

    /**
     * @param  Text     $text
     * @param  Request  $request
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function updateDescription(Text $text, Request $request): JsonResponse
    {
        $this->authorize('update', $text);

        return $this->commandBus->execute(new UpdateDescriptionCommand($text));

        // return response()->json(['success' => Text::updateOrCreate(['id' => $id], ['description' => Input::get('content')])]);
    }
}