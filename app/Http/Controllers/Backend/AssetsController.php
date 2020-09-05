<?php


namespace App\Http\Controllers\Backend;

use Request;
use App\Helpers\Auth;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Scandinaver\Common\Domain\Model\Language;
use Scandinaver\Learn\Domain\Model\Asset;
use Scandinaver\Learn\Domain\Model\Card;
use Scandinaver\Learn\Domain\Model\Word;
use Scandinaver\Learn\UI\Command\AddBasicLevelCommand;
use Scandinaver\Learn\UI\Command\AddWordAndTranslateCommand;
use Scandinaver\Learn\UI\Command\CreateTranslateCommand;
use Scandinaver\Learn\UI\Command\EditTranslateCommand;
use Scandinaver\Learn\UI\Command\SetTranslateForCardCommand;
use Scandinaver\Learn\UI\Command\UpdateAssetCommand;
use Scandinaver\Learn\UI\Command\UploadAudioCommand;
use Scandinaver\Learn\UI\Query\FindAudioQuery;
use Scandinaver\Learn\UI\Query\GetAssetsByTypeQuery;
use Scandinaver\Learn\UI\Query\GetExamplesForCardQuery;
use Scandinaver\Learn\UI\Query\GetTranslatesByWordQuery;
use Scandinaver\Learn\UI\Query\GetUnusedSentencesQuery;

/**
 * Created by PhpStorm.
 * User: john
 * Date: 30.08.2017
 * Time: 20:29
 * Class AssetsController
 *
 * @package Application\Controllers\Admin
 */
class AssetsController extends Controller
{
    public function index(Language $language)
    {
        return response()->json([
            'words' => $this->queryBus->execute(new GetAssetsByTypeQuery($language, Asset::TYPE_WORDS)),
            'sentences' => $this->queryBus->execute(new GetAssetsByTypeQuery($language, Asset::TYPE_SENTENCES)),
        ]);
    }

    public function findAudio(Word $word): JsonResponse
    {
        return response()->json($this->queryBus->execute(new FindAudioQuery($word)));
    }

    public function showAsset(Asset $asset): JsonResponse
    {
        return response()->json($asset);
    }

    public function showValues(Language $language, Word $word): JsonResponse
    {
        return response()->json($this->queryBus->execute(new GetTranslatesByWordQuery($word)));
    }

    public function showExamples(Language $language, Card $card): JsonResponse
    {
        return response()->json($this->queryBus->execute(new GetExamplesForCardQuery($card)));
    }

    public function changeUsedTranslate(Request $request): JsonResponse
    {
        $this->commandBus->execute(new SetTranslateForCardCommand($request->toArray()));

        return response()->json(null, 200);
    }

    public function editTranslate(Request $request): JsonResponse
    {
        $this->commandBus->execute(new EditTranslateCommand($request->toArray()));

        if ($request->get('examples')) {
            foreach (Input::get('examples') as $example) {
                $this->commandBus->execute(new CreateTranslateCommand($request->get('card_id'), $example));
            }
        }

        return response()->json(null, 200);
    }

    public function uploadAudio(Request $request, Word $word): JsonResponse
    {
        $this->commandBus->execute(new UploadAudioCommand($word, $request->file('audiofile')));

        return response()->json(null, 200);
    }

    public function getSentences(): JsonResponse
    {
        return response()->json($this->queryBus->execute(new GetUnusedSentencesQuery()));
    }

    /**
     * TODO: сделать нормально
     *
     */
    public function addBasicAssetLevel(Request $request): JsonResponse
    {
        $this->commandBus->execute(new AddBasicLevelCommand($request->toArray()));

        return response()->json(null, 201);
    }

    public function addPair(Request $request): JsonResponse
    {
        $this->commandBus->execute(new AddWordAndTranslateCommand($request->toArray()));

        return response()->json(null, 201);
    }


    public function uploadSentences()
    {
        // TODO: импорт предложений Excel
    }

    public function changeAsset(Request $request, Asset $asset): JsonResponse
    {
        $this->commandBus->execute(new UpdateAssetCommand(Auth::user(), $asset, $request->toArray()));

        return response()->json(null, 200);
    }
}