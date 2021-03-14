<?php


namespace App\Http\Controllers\Learn;

use App\Helpers\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCardRequest;
use App\Http\Requests\SearchRequest;
use Doctrine\DBAL\DBALException;
use Gate;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Scandinaver\Common\Domain\Model\Language;
use Scandinaver\Learn\Domain\Exceptions\LanguageNotFoundException;
use Scandinaver\Learn\Domain\Permissions\Asset;
use Scandinaver\Learn\Domain\Permissions\Card;
use Scandinaver\Learn\Domain\Services\WordService;
use Scandinaver\Learn\UI\Command\AddCardToAssetCommand;
use Scandinaver\Learn\UI\Command\CreateCardCommand;
use Scandinaver\Learn\UI\Command\DeleteCardFromAssetCommand;
use Scandinaver\Learn\UI\Command\UpdateCardCommand;
use Scandinaver\Learn\UI\Command\UploadCsvSentencesCommand;
use Scandinaver\Shared\CommandBus;
use Scandinaver\Shared\EventBusNotFoundException;
use Scandinaver\Shared\QueryBus;

/**
 * Class CardController
 *
 * @package App\Http\Controllers\Learn
 */
class CardController extends Controller
{

    private WordService $wordService;

    public function __construct(CommandBus $commandBus, QueryBus $queryBus, WordService $wordService)
    {
        parent::__construct($commandBus, $queryBus);
        $this->wordService = $wordService;
    }

    public function index()
    {
    }

    public function show()
    {
    }

    /**
     * @param  string  $language
     * @param  int     $card
     * @param  int     $asset
     *
     * @return JsonResponse
     * @throws AuthorizationException
     * @throws EventBusNotFoundException
     */
    public function store(string $language, int $card, int $asset): JsonResponse
    {

    }

    /**
     * @param  int      $card
     * @param  Request  $request
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function update(int $card, Request $request): JsonResponse
    {
        Gate::authorize(Card::UPDATE, $card);

        return response()->json($this->commandBus->execute(new UpdateCardCommand($card, $request->toArray())));
    }


    /**
     * @param  Language           $language
     * @param  CreateCardRequest  $request
     *
     * @return JsonResponse
     * @throws AuthorizationException
     * @throws EventBusNotFoundException
     */
    public function create(Language $language, CreateCardRequest $request): JsonResponse
    {
        Gate::authorize(Card::CREATE);

        return $this->execute(new CreateCardCommand(Auth::user(), $language, $request->get('word'),
            $request->get('translate')), JsonResponse::HTTP_CREATED);
    }

    /**
     * @param  string  $language
     * @param  int     $card
     * @param  int     $asset
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function destroy(string $language, int $card, int $asset): JsonResponse
    {

    }

    /**
     * @param  string         $language
     * @param  SearchRequest  $request
     *
     * @return JsonResponse
     * @throws AuthorizationException
     * @throws LanguageNotFoundException
     */
    public function search(string $language, SearchRequest $request): JsonResponse
    {
        Gate::authorize(Card::SEARCH);

        $words = $this->wordService->translate($language, $request);

        return response()->json($words);
    }

    /**
     * @param  string   $languageId
     * @param  Request  $request
     *
     * @return JsonResponse
     * @throws EventBusNotFoundException
     */
    public function uploadSentences(string $languageId, Request $request): JsonResponse
    {
        $file = $request->file('file');

        return $this->execute(new UploadCsvSentencesCommand($languageId, $file), JsonResponse::HTTP_CREATED);
    }

}