<?php


namespace App\Http\Controllers\Learn;

use App\Helpers\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCardRequest;
use App\Http\Requests\SearchRequest;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Scandinaver\Common\Domain\Model\Language;
use Scandinaver\Learn\Domain\Exceptions\CardAlreadyAddedException;
use Illuminate\Http\Request;
use Scandinaver\Learn\Domain\Services\WordService;
use Scandinaver\Learn\UI\Command\AddCardToAssetCommand;
use Scandinaver\Learn\UI\Command\CreateCardCommand;
use Scandinaver\Learn\UI\Command\DeleteCardFromAssetCommand;
use Scandinaver\Learn\UI\Command\UpdateCardCommand;
use Scandinaver\Learn\UI\Command\UploadCsvSentencesCommand;
use Scandinaver\Shared\CommandBus;
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

    public function store(string $language, int $card, int $asset): JsonResponse
    {
        try {
            $this->commandBus->execute(new AddCardToAssetCommand(Auth::user(), $language, $card, $asset));
        } catch (CardAlreadyAddedException $e) {
            return response()->json($e->getMessage(), 500);
        }
        return response()->json(NULL, 201);
    }

    public function update(int $card, Request $request): JsonResponse
    {
        return response()->json($this->commandBus->execute(new UpdateCardCommand($card, $request->toArray())));
    }

    public function create(Language $language, CreateCardRequest $request): JsonResponse
    {
        $card = $this->commandBus->execute(new CreateCardCommand(
            Auth::user(), $language, $request->get('word'), $request->get('translate')
        ));

        return response()->json($card, 201);
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
      //  $this->authorize('delete', [$card, $asset]);

        $this->commandBus->execute(new DeleteCardFromAssetCommand(Auth::user(), $card, $asset));

        return response()->json(NULL, 204);
    }

    public function search(string $language, SearchRequest $request): JsonResponse
    {
        $words = $this->wordService->translate($language, $request);

        return response()->json($words);
    }

    public function uploadSentences(string $languageId, Request $request)
    {
        $file = $request->file('file');

        return $this->execute(new UploadCsvSentencesCommand($languageId, $file), JsonResponse::HTTP_CREATED);
    }
}