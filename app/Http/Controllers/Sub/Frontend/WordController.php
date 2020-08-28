<?php


namespace App\Http\Controllers\Sub\Frontend;

use App\Http\Controllers\Controller;
use Scandinaver\Common\Domain\Model\Language;
use App\Http\Requests\{SearchRequest, CreateWordRequest};
use Scandinaver\Learn\Domain\Services\WordService;
use Doctrine\DBAL\DBALException;
use Illuminate\Http\{Request, JsonResponse};

/**
 * Class WordController
 *
 * @package App\Http\Controllers\Sub\Frontend
 */
class WordController extends Controller
{
    protected WordService $wordService;

    /**
     * WordController constructor.
     *
     * @param WordService $wordService
     */
    public function __construct(WordService $wordService)
    {
        $this->wordService = $wordService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        //
    }

    public function store(Language $language, CreateWordRequest $request): JsonResponse
    {
        $item = $this->wordService->create($request);

        return response()->json($item, 201);
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    /**
     * @return JsonResponse
     * @throws DBALException
     */
    public function search(Language $language, SearchRequest $request): JsonResponse
    {
        $words = $this->wordService->translate($language, $request);

        return response()->json($words);
    }
}
