<?php


namespace App\Http\Controllers\Learn;

use App\Helpers\Auth;
use App\Http\Controllers\Controller;
use Exception;
use Gate;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\{JsonResponse, Request};
use Scandinaver\Learn\Domain\Model\Asset;
use Scandinaver\Learn\UI\Command\AddBasicLevelCommand;
use Scandinaver\Learn\UI\Command\AddWordAndTranslateCommand;
use Scandinaver\Learn\UI\Command\CreateAssetCommand;
use Scandinaver\Learn\UI\Command\CreateTranslateCommand;
use Scandinaver\Learn\UI\Command\DeleteAssetCommand;
use Scandinaver\Learn\UI\Command\EditTranslateCommand;
use Scandinaver\Learn\UI\Command\SetTranslateForCardCommand;
use Scandinaver\Learn\UI\Command\UpdateAssetCommand;
use Scandinaver\Learn\UI\Command\UploadAudioCommand;
use Scandinaver\Learn\UI\Query\AssetForUserByTypeQuery;
use Scandinaver\Learn\UI\Query\AssetsQuery;
use Scandinaver\Learn\UI\Query\CardsOfAssetQuery;
use Scandinaver\Learn\UI\Query\FindAudioQuery;
use Scandinaver\Learn\UI\Query\GetAssetsByTypeQuery;
use Scandinaver\Learn\UI\Query\GetExamplesForCardQuery;
use Scandinaver\Learn\UI\Query\GetTranslatesByWordQuery;
use Scandinaver\Learn\UI\Query\GetUnusedSentencesQuery;
use Scandinaver\Learn\UI\Query\PersonalAssetsQuery;

/**
 * Class AssetController
 *
 * @package App\Http\Controllers\Learn
 */
class AssetController extends Controller
{
    public function show(string $languageId, int $assetId): JsonResponse
    {
        Gate::authorize('view-assets');

        return $this->execute(new CardsOfAssetQuery($languageId, Auth::user(), $assetId));
    }

    public function store(string $languageId, Request $request): JsonResponse
    {
        Gate::authorize('create-asset');

        return $this->execute(new CreateAssetCommand($languageId, Auth::user(), $request->get('title')), JsonResponse::HTTP_CREATED);
    }

    /**
     * @param  string   $languageId
     * @param  int      $assetId
     * @param  Request  $request
     *
     * @return JsonResponse
     * @throws Exception
     */
    public function update(string $languageId, int $assetId, Request $request): JsonResponse
    {
        Gate::authorize('update-asset', $assetId);

        return $this->execute(new UpdateAssetCommand(Auth::user(), $assetId, $request->toArray()));
    }

    /**
     * @param  string  $languageId
     * @param  int     $assetId
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function destroy(string $languageId, int $assetId): JsonResponse
    {
        Gate::authorize('delete-asset', $assetId);

        return $this->execute(new DeleteAssetCommand($assetId), JsonResponse::HTTP_NO_CONTENT);
    }

    public function getWords(string $languageId): JsonResponse
    {
        return $this->execute(new AssetForUserByTypeQuery($languageId, Auth::user(), Asset::TYPE_WORDS));
    }

    public function getSentences(string $languageId): JsonResponse
    {
        return $this->execute(new AssetForUserByTypeQuery($languageId, Auth::user(), Asset::TYPE_SENTENCES));
    }

    public function getAllSentences(string $languageId): JsonResponse
    {
        return $this->execute(new GetUnusedSentencesQuery($languageId));
    }

    public function getPersonal(string $languageId): JsonResponse
    {
        return $this->execute(new PersonalAssetsQuery(Auth::user(), $languageId));
    }

    public function index(string $languageId): JsonResponse
    {
        return response()->json([
            'words' => $this->queryBus->execute(new GetAssetsByTypeQuery($languageId, Asset::TYPE_WORDS)),
            'sentences' => $this->queryBus->execute(new GetAssetsByTypeQuery($languageId, Asset::TYPE_SENTENCES)),
        ]);
    }

    public function findAudio(int $wordId): JsonResponse
    {
        return $this->execute(new FindAudioQuery($wordId));
    }

    public function showAsset(int $assetId): JsonResponse
    {
        return response()->json($assetId);
    }

    public function showValues(string $languageId, int $wordId): JsonResponse
    {
        return $this->execute(new GetTranslatesByWordQuery($wordId));
    }

    public function showExamples(string $languageId, int $cardId): JsonResponse
    {
        return $this->execute(new GetExamplesForCardQuery($cardId));
    }

    public function changeUsedTranslate(Request $request): JsonResponse
    {
        return $this->execute(new SetTranslateForCardCommand($request->toArray()));
    }

    public function editTranslate(Request $request): JsonResponse
    {
        $this->execute(new EditTranslateCommand($request->toArray()));

        if ($request->get('examples')) {
            foreach ($request->get('examples') as $example) {
                $this->execute(new CreateTranslateCommand($request->get('card_id'), $example));
            }
        }

        return response()->json(null, 200);
    }

    public function uploadAudio(Request $request, int $wordId): JsonResponse
    {
        return $this->execute(new UploadAudioCommand($wordId, $request->file('audiofile')), JsonResponse::HTTP_CREATED);
    }

    public function addBasicAssetLevel(string $languageId, Request $request): JsonResponse
    {
        return $this->execute(new AddBasicLevelCommand($languageId, $request->toArray()), JsonResponse::HTTP_CREATED);
    }

    public function addPair(Request $request): JsonResponse
    {
        return $this->execute(new AddWordAndTranslateCommand($request->toArray()), JsonResponse::HTTP_CREATED);
    }

    public function changeAsset(int $assetId, Request $request): JsonResponse
    {
        return $this->execute(new UpdateAssetCommand(Auth::user(), $assetId, $request->toArray()));
    }

    public function assetsMobile(string $languageId): JsonResponse
    {
        // $validator = Validator::make(
        //     ['language' => $language],
        //     [
        //         'language' => 'exists:Scandinaver\Common\Domain\Model\Language,name'
        //     ],
        //     [
        //         'exists' => 'Неверный параметр'
        //     ]
        // );
        //
        // if ($validator->fails()) {
        //     return response()->json([$validator->errors()], 400);
        // }

        return $this->execute(new AssetsQuery(auth('api')->user(), $languageId));
    }
}