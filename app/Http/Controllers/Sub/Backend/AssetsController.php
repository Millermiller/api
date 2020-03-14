<?php


namespace App\Http\Controllers\Sub\Backend;

use Request;
use App\Helpers\Auth;
use ReflectionException;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Scandinaver\Learn\Application\Commands\AddBasicLevelCommand;
use Scandinaver\Learn\Application\Commands\AddWordAndTranslateCommand;
use Scandinaver\Learn\Application\Commands\CreateTranslateCommand;
use Scandinaver\Learn\Application\Commands\EditTranslateCommand;
use Scandinaver\Learn\Application\Commands\SetTranslateForCardCommand;
use Scandinaver\Learn\Application\Commands\UpdateAssetCommand;
use Scandinaver\Learn\Application\Commands\UploadAudioCommand;
use Scandinaver\Learn\Application\Query\FindAudioQuery;
use Scandinaver\Learn\Application\Query\GetExamplesForCardQuery;
use Scandinaver\Learn\Application\Query\GetTranslatesByWordQuery;
use Scandinaver\Learn\Application\Query\GetUnusedSentencesQuery;
use Scandinaver\Learn\Domain\Asset;
use Scandinaver\Learn\Domain\Card;
use Scandinaver\Learn\Domain\Word;

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
    public function index()
    {
        /*
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
        */
    }

    /**
     * @param Word $word
     * @return JsonResponse
     * @throws ReflectionException
     */
    public function findAudio(Word $word): JsonResponse
    {
        return response()->json($this->queryBus->execute(new FindAudioQuery($word)));
    }

    /**
     * @param Asset $asset
     * @return JsonResponse
     */
    public function showAsset(Asset $asset): JsonResponse
    {
        return response()->json($asset);
    }

    /**
     * @param Word $word
     * @return JsonResponse
     * @throws ReflectionException
     */
    public function showValues(Word $word): JsonResponse
    {
        return response()->json($this->queryBus->execute(new GetTranslatesByWordQuery($word)));
    }

    /**
     * @param Card $card
     * @return JsonResponse
     * @throws ReflectionException
     */
    public function showExamples(Card $card): JsonResponse
    {
        return response()->json($this->queryBus->execute(new GetExamplesForCardQuery($card)));
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws ReflectionException
     */
    public function changeUsedTranslate(Request $request): JsonResponse
    {
        $this->commandBus->execute(new SetTranslateForCardCommand($request->toArray()));

        return response()->json(null, 200);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws ReflectionException
     */
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

    /**
     * @param Word $word
     * @param Request $request
     * @return JsonResponse
     * @throws ReflectionException
     */
    public function uploadAudio(Request $request, Word $word): JsonResponse
    {
        $this->commandBus->execute(new UploadAudioCommand($word, $request->file('audiofile')));

        return response()->json(null, 200);
    }

    /**
     * @return JsonResponse
     * @throws ReflectionException
     */
    public function getSentences(): JsonResponse
    {
        return response()->json($this->queryBus->execute(new GetUnusedSentencesQuery()));
    }

    /**
     * TODO: сделать нормально
     * @param Request $request
     * @return JsonResponse
     * @throws ReflectionException
     */
    public function addBasicAssetLevel(Request $request): JsonResponse
    {
        $this->commandBus->execute(new AddBasicLevelCommand($request->toArray()));

        return response()->json(null, 201);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws ReflectionException
     */
    public function addPair(Request $request): JsonResponse
    {
        $this->commandBus->execute(new AddWordAndTranslateCommand($request->toArray()));

        return response()->json(null, 201);
    }


    public function uploadSentences()
    {
        // TODO: импорт предложений Excel
    }

    /**
     * @param Request $request
     * @param Asset $asset
     * @return JsonResponse
     * @throws ReflectionException
     */
    public function changeAsset(Request $request, Asset $asset): JsonResponse
    {
        $this->commandBus->execute(new UpdateAssetCommand(Auth::user(), $asset, $request->toArray()));

        return response()->json(null, 200);
    }
}