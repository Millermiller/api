<?php


namespace App\Http\Controllers\Translate;

use App\Helpers\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\translate\CreateTextRequest;
use App\Http\Requests\translate\UpdateTextRequest;
use Exception;
use Gate;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\{JsonResponse, Request};
use Intervention\Image\ImageManagerStatic as Image;
use Scandinaver\Translate\Domain\Permission\Text;
use Scandinaver\Translate\UI\Command\CompleteTextCommand;
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
use Upload\{File, Storage\FileSystem};
use Upload\Validation\{Mimetype, Size};

/**
 * Created by PhpStorm.
 * User: john
 * Date: 30.08.2017
 * Time: 20:39
 * Class TextController
 *
 * @package App\Http\Controllers\Translate
 */
class TextController extends Controller
{

    /**
     * @param  string  $language
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function index(string $language): JsonResponse
    {
        Gate::authorize(Text::VIEW);

        return $this->execute(new GetTextsQuery($language));
    }

    /**
     * @param  string  $language
     * @param  int     $textId
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function show(string $language, int $textId): JsonResponse
    {
        Gate::authorize(Text::SHOW, $textId);

        return $this->execute(new GetTextQuery($textId));
    }

    /**
     * @param  CreateTextRequest  $request
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function store(CreateTextRequest $request): JsonResponse
    {
        Gate::authorize(Text::CREATE);

        return $this->execute(new CreateTextCommand());

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
     * @param  UpdateTextRequest  $request
     * @param  int                $id
     *
     * @throws AuthorizationException
     */
    public function update(UpdateTextRequest $request, int $id)
    {
        Gate::authorize(Text::UPDATE, $id);
    }

    /**
     * @param  int  $textId
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function destroy(int $textId): JsonResponse
    {
        Gate::authorize(Text::DELETE, $textId);

        return $this->execute(new DeleteTextCommand($textId));

        // try {
        //     /** @var int $text */
        //     $text = Text::findOrFail($id);
        //     $text->result()->delete();
        //     return response()->json(['success' => $text->delete()]);
        // } catch (\Exception $e) {
        //     return response()->json(['success' => false, 'msg' => $e->getMessage()]);
        // }
    }

    /**
     * @param  int  $textId
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function complete(int $textId): JsonResponse
    {
        Gate::authorize(Text::COMPLETE, $textId);

        return $this->execute(new CompleteTextCommand(Auth::user(), $textId));
    }

    /**
     * @param  int  $textId
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function view(int $textId): JsonResponse
    {
        Gate::authorize(Text::SHOW, $textId);

        return $this->execute(new GetTextQuery($textId));

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
     * @param  int  $textId
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function publish(int $textId): JsonResponse
    {
        Gate::authorize(Text::UPDATE, $textId);

        return $this->execute(new PublishTextCommand($textId));

        // $publish = (int)Input::get('published');
        // $id      = Input::get('id');
        // $result = Text::find($id)->update(['published' => $publish]);
        // return response()->json(['success' => $result]);
    }

    /**
     * @param  int      $textId
     * @param  Request  $request
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function addExtras(int $textId, Request $request): JsonResponse
    {
        Gate::authorize(Text::UPDATE, $textId);

        return $this->execute(new CreateTextExtraCommand());

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
     * @param  int      $textId
     * @param  Request  $request
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function saveSentences(int $textId, Request $request): JsonResponse
    {
        Gate::authorize(Text::UPDATE, $textId);

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

    /**
     * @param  int  $word
     *
     * @return JsonResponse
     */
    public function getSynonyms(int $word): JsonResponse
    {
        return $this->execute(new GetSynonymsQuery($word));

        //return response()->json([
        //    'success'  => true,
        //    'synonyms' => Synonym::where('word_id', $id)->get()
        //]);
    }

    /**
     * @param  Request  $request
     *
     * @return JsonResponse
     */
    public function addSynonym(Request $request): JsonResponse
    {
        return $this->execute(new CreateSynonymCommand($request->toArray()));

        // $word_id = Input::get('word_id');
        // $synonym = Input::get('synonym');
        // return response()->json(['success' => Synonym::create(['word_id' => $word_id, 'synonym' => $synonym])]);
    }

    /**
     * @param  int  $synonym
     *
     * @return JsonResponse
     */
    public function deleteSynonym(int $synonym): JsonResponse
    {
        return $this->execute(new DeleteSynonymCommand($synonym));
        // return response()->json(['success' => Synonym::destroy($id)]);
    }

    /**
     * @param  int  $textId
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function uploadImage(int $textId): JsonResponse
    {
        Gate::authorize(Text::UPDATE, $textId);

        $this->authorize('update', Text::class);

        $storage      = new FileSystem(public_path() . '/uploads/photo/');
        $file         = new File('file', $storage);
        $new_filename = uniqid();
        $file->setName($new_filename);
        $file->addValidations([
            new Mimetype(['image/png', 'image/jpg', 'image/jpeg']),
            new Size('5M'),
        ]);
        try {
            $file->upload();
            $url = '/uploads/photo/' . $file->getNameWithExtension();

            // Image::configure(array('driver' => 'GD'));
            $img = Image::make(public_path() . $url);

            if ($img->getWidth() > 1000) {
                $img->widen(600);
            }

            if ($img->getHeight() > 1000) {
                $img->heighten(600);
            }

            $img->save(NULL, 100);

            $thumb = Image::make(public_path() . $url);
            $thumb->widen(150);
            $thumb->save(public_path() . '/uploads/thumbs/' . $file->getNameWithExtension());

            $text        = Text::find($id);
            $text->image = '/uploads/photo/' . $file->getNameWithExtension();

            return response()->json(['success' => $text->save()]);
        } catch (Exception $e) {
            $errors  = $file->getErrors();
            $message = implode(', ', $errors);

            return response()->json([
                'msg'     => $message,
                'success' => FALSE,
                'mess'    => $e->getMessage(),
            ]);
        }
    }

    /**
     * @param  int      $textId
     * @param  Request  $request
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function updateDescription(int $textId, Request $request): JsonResponse
    {
        Gate::authorize(Text::UPDATE, $textId);

        return $this->execute(new UpdateDescriptionCommand($textId));
        // return response()->json(['success' => Text::updateOrCreate(['id' => $id], ['description' => Input::get('content')])]);
    }

}