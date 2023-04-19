<?php


namespace App\Http\Controllers\Learn;

use App\Helpers\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\FilteringRequest;
use App\Http\Requests\HasLanguageRequest;
use App\Http\Requests\Learn\CreateAssetRequest;
use App\Http\Requests\Learn\UpdateAssetRequest;
use Exception;
use Gate;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\{JsonResponse, Request};
use JsonMapper_Exception;
use Scandinaver\Learning\Asset\Domain\Permission\Card;
use Scandinaver\Learning\Asset\UI\Command\AddCardToAssetCommand;
use Scandinaver\Learning\Asset\UI\Command\AddTermAndTranslateCommand;
use Scandinaver\Learning\Asset\UI\Command\CreateAssetCommand;
use Scandinaver\Learning\Asset\UI\Command\CreateTranslateCommand;
use Scandinaver\Learning\Asset\UI\Command\DeleteAssetCommand;
use Scandinaver\Learning\Asset\UI\Command\DeleteCardFromAssetCommand;
use Scandinaver\Learning\Asset\UI\Command\EditTranslateCommand;
use Scandinaver\Learning\Asset\UI\Command\UpdateAssetCommand;
use Scandinaver\Learning\Asset\UI\Command\UploadAudioCommand;
use Scandinaver\Learning\Asset\UI\Query\AssetsQuery;
use Scandinaver\Learning\Asset\UI\Query\CardsOfAssetQuery;
use Scandinaver\Learning\Asset\UI\Query\FindAudioQuery;
use Scandinaver\Learning\Asset\UI\Query\GetExamplesForCardQuery;
use Scandinaver\Learning\Asset\UI\Query\GetTranslatesByTermQuery;
use Scandinaver\Learning\Asset\UI\Query\PersonalAssetsQuery;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class AssetController
 *
 * @package App\Http\Controllers\Learn
 */
class AssetController extends Controller
{

    /**
     * @param  FilteringRequest  $request
     *
     * @return JsonResponse
     * @throws AuthorizationException
     * @throws JsonMapper_Exception
     */
    public function index(FilteringRequest $request): JsonResponse
    {
        Gate::authorize(\Scandinaver\Learning\Asset\Domain\Permission\Asset::VIEW);

        return $this->execute(new AssetsQuery($request->getRequestParameters(), Auth::user()));
    }

    /**
     * @param  string  $id
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function show(string $id): JsonResponse
    {
        Gate::authorize(\Scandinaver\Learning\Asset\Domain\Permission\Asset::SHOW, $id);

        return $this->execute(new CardsOfAssetQuery(Auth::user(), $id));
    }

    /**
     * @param  CreateAssetRequest  $request
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function store(CreateAssetRequest $request): JsonResponse
    {
        Gate::authorize(\Scandinaver\Learning\Asset\Domain\Permission\Asset::CREATE);

        $data = $request->toArray();

        return $this->execute(new CreateAssetCommand(Auth::user(), $data), Response::HTTP_CREATED);
    }

    /**
     * @param  string              $id
     * @param  UpdateAssetRequest  $request
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function update(string $id, UpdateAssetRequest $request): JsonResponse
    {
        Gate::authorize(\Scandinaver\Learning\Asset\Domain\Permission\Asset::UPDATE, $id);

        return $this->execute(new UpdateAssetCommand(Auth::user(), $id, $request->toArray()));
    }

    /**
     * @param  string  $id
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function destroy(string $id): JsonResponse
    {
        Gate::authorize(\Scandinaver\Learning\Asset\Domain\Permission\Asset::DELETE, $id);

        return $this->execute(new DeleteAssetCommand(Auth::user(), $id), Response::HTTP_NO_CONTENT);
    }

    /**
     * @param  HasLanguageRequest  $request
     *
     * @return JsonResponse
     */
    public function testGetPersonalAssets(HasLanguageRequest $request): JsonResponse
    {
        $language = $request->get('lang');

        return $this->execute(new PersonalAssetsQuery(Auth::user(), $language));
    }

    /**
     * @param  int  $termId
     *
     * @return JsonResponse
     */
    public function findAudio(int $termId): JsonResponse
    {
        return $this->execute(new FindAudioQuery($termId));
    }

    /**
     * @param  int  $termId
     *
     * @return JsonResponse
     */
    public function showValues(int $termId): JsonResponse
    {
        return $this->execute(new GetTranslatesByTermQuery($termId));
    }

    /**
     * @param  int  $cardId
     *
     * @return JsonResponse
     */
    public function showExamples(int $cardId): JsonResponse
    {
        return $this->execute(new GetExamplesForCardQuery($cardId));
    }

    /**
     * @param  Request  $request
     *
     * @return JsonResponse
     */
    public function editTranslate(Request $request): JsonResponse
    {
        $this->execute(new EditTranslateCommand($request->toArray()));

        if ($request->get('examples')) {
            foreach ($request->get('examples') as $example) {
                $this->execute(new CreateTranslateCommand($request->get('card_id'), $example));
            }
        }

        return response()->json(NULL);
    }

    /**
     * @param  Request  $request
     * @param  int      $termId
     *
     * @return JsonResponse
     */
    public function uploadAudio(Request $request, int $termId): JsonResponse
    {
        return $this->execute(new UploadAudioCommand($termId, $request->file('audiofile')), Response::HTTP_CREATED);
    }

    /**
     * @param  Request  $request
     *
     * @return JsonResponse
     */
    public function addPair(Request $request): JsonResponse
    {
        return $this->execute(new AddTermAndTranslateCommand($request->toArray()), Response::HTTP_CREATED);
    }

    /**
     * @param  string  $asset
     * @param  int     $card
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function addCard(string $asset, int $card): JsonResponse
    {
        Gate::authorize(\Scandinaver\Learning\Asset\Domain\Permission\Asset::ADD_CARD);

        return $this->execute(new AddCardToAssetCommand(Auth::user(), $asset, $card), Response::HTTP_CREATED);
    }

    /**
     * @param  string  $asset
     * @param  int     $card
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function removeCard(string $asset, int $card): JsonResponse
    {
        Gate::authorize(Card::DELETE, [$card, $asset]); //todo: change permission

        return $this->execute(new DeleteCardFromAssetCommand(Auth::user(), $asset, $card),
            Response::HTTP_NO_CONTENT);
    }

    /**
     * @param  string  $languageId
     *
     * @return JsonResponse
     * @throws Exception
     */
    public function assetsMobile(string $languageId): JsonResponse
    {
        // $validator = Validator::make(
        //     ['language' => $language],
        //     [
        //         'language' => 'exists:Scandinaver\Common\Domain\Entity\Language,name'
        //     ],
        //     [
        //         'exists' => 'Неверный параметр'
        //     ]
        // );
        //
        // if ($validator->fails()) {
        //     return response()->json([$validator->errors()], 400);
        // }

        /** @var UserInterface $user */
        $user = auth('api')->user();

        return $this->execute(new AssetsQuery($user, $languageId));
    }
}