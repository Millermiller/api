<?php


namespace App\Http\Controllers\Learn;

use App\Helpers\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\Learn\CreateCardRequest;
use App\Http\Requests\Learn\UpdateCardRequest;
use App\Http\Requests\Learn\SearchRequest;
use Gate;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Scandinaver\Learn\Domain\Permission\Card;
use Scandinaver\Learn\UI\Command\CreateCardCommand;
use Scandinaver\Learn\UI\Command\UpdateCardCommand;
use Scandinaver\Learn\UI\Command\UploadCsvSentencesCommand;
use Scandinaver\Learn\UI\Query\SearchCardQuery;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * Class CardController
 *
 * @package App\Http\Controllers\Learn
 */
class CardController extends Controller
{

    public function index()
    {
        throw new HttpException('Not implemented');
    }

    public function show()
    {
        throw new HttpException('Not implemented');
    }

    /**
     * @param  CreateCardRequest  $request
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function store(CreateCardRequest $request): JsonResponse
    {
        Gate::authorize(Card::CREATE);

        return $this->execute(new CreateCardCommand(
            Auth::user(),
            $request->get('language'),
            $request->get('word'),
            $request->get('translate')
        ),
            Response::HTTP_CREATED);
    }

    /**
     * @param  int                $card
     * @param  UpdateCardRequest  $request
     *
     * @return JsonResponse
     * @throws AuthorizationException
     * @throws BindingResolutionException
     */
    public function update(int $card, UpdateCardRequest $request): JsonResponse
    {
        Gate::authorize(Card::UPDATE, $card);

        return response()->json($this->commandBus->execute(new UpdateCardCommand($card, $request->toArray())));
    }

    /**
     * @param  string  $language
     * @param  int     $card
     * @param  int     $asset
     *
     * @return JsonResponse
     */
    public function destroy(string $language, int $card, int $asset): JsonResponse
    {
        throw new HttpException('Not implemented');
    }

    /**
     * @param  SearchRequest  $request
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function search(SearchRequest $request): JsonResponse
    {
        Gate::authorize(Card::SEARCH);

        $data = $request->toArray();

        return $this->execute(new SearchCardQuery($data));
    }

    /**
     * @param  string   $languageId
     * @param  Request  $request
     *
     * @return JsonResponse
     */
    public function uploadSentences(string $languageId, Request $request): JsonResponse
    {
        $file = $request->file('file');

        return $this->execute(new UploadCsvSentencesCommand($languageId, $file), Response::HTTP_CREATED);
    }

}