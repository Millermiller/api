<?php


namespace App\Http\Controllers\Translate;

use App\Helpers\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\HasLanguageRequest;
use App\Http\Requests\Translate\CreateTextRequest;
use App\Http\Requests\Translate\UpdateTextRequest;
use Gate;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\{JsonResponse, Request};
use Scandinaver\Learning\Translate\Domain\Permission\Text;
use Scandinaver\Learning\Translate\UI\Command\CompleteTextCommand;
use Scandinaver\Learning\Translate\UI\Command\CreateSynonymCommand;
use Scandinaver\Learning\Translate\UI\Command\CreateTextCommand;
use Scandinaver\Learning\Translate\UI\Command\DeleteSynonymCommand;
use Scandinaver\Learning\Translate\UI\Command\DeleteTextCommand;
use Scandinaver\Learning\Translate\UI\Command\UpdateDescriptionCommand;
use Scandinaver\Learning\Translate\UI\Command\UpdateTextCommand;
use Scandinaver\Learning\Translate\UI\Command\UploadTextImageCommand;
use Scandinaver\Learning\Translate\UI\Query\GetSynonymsQuery;
use Scandinaver\Learning\Translate\UI\Query\GetTextQuery;
use Scandinaver\Learning\Translate\UI\Query\GetTextsQuery;

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
     * @param  HasLanguageRequest  $request
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function index(HasLanguageRequest $request): JsonResponse
    {
        Gate::authorize(Text::VIEW);

        $language = $request->get('lang');

        return $this->execute(new GetTextsQuery($language));
    }

    /**
     * @param  int  $id
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function show(int $id): JsonResponse
    {
        Gate::authorize(Text::SHOW, $id);

        return $this->execute(new GetTextQuery($id));
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

        return $this->execute(new CreateTextCommand($request->toArray()));
    }

    /**
     * @param  UpdateTextRequest  $request
     * @param  int                $id
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function update(int $id, UpdateTextRequest $request): JsonResponse
    {
        Gate::authorize(Text::UPDATE, $id);

        return $this->execute(new UpdateTextCommand($id, $request->toArray()));
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
     * @param  int      $id
     * @param  Request  $request
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function uploadImage(int $id, Request $request): JsonResponse
    {
        Gate::authorize(Text::UPDATE, $id);

        return $this->execute(new UploadTextImageCommand($id, $request->file('file')));
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