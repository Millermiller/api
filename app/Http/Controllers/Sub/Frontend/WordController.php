<?php


namespace App\Http\Controllers\Sub\Frontend;

use App\Http\Controllers\Controller;
use Scandinaver\Common\Domain\Language;
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
    /**
     * @var WordService
     */
    protected $wordService;

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

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateWordRequest $request
     *
     * @return JsonResponse
     */
    public function store(CreateWordRequest $request): JsonResponse
    {
        $item = $this->wordService->create($request);

        return response()->json($item, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return void
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int     $id
     *
     * @return void
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return void
     */
    public function destroy($id)
    {
        //
    }

    /**
     * @param Language      $language
     * @param SearchRequest $request
     *
     * @return JsonResponse
     * @throws DBALException
     */
    public function search(Language $language, SearchRequest $request): JsonResponse
    {
        $words = $this->wordService->translate($language, $request);

        return response()->json($words);
    }
}
