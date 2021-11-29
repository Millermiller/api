<?php


namespace App\Http\Controllers\Translate;


use App\Http\Controllers\Controller;
use App\Http\Requests\Translate\CreateSynonymRequest;
use Illuminate\Http\JsonResponse;
use Scandinaver\Learning\Translate\UI\Command\CreateSynonymCommand;
use Scandinaver\Learning\Translate\UI\Command\DeleteSynonymCommand;
use Scandinaver\Learning\Translate\UI\Query\GetSynonymsQuery;

/**
 * Class SynonymController
 *
 * @package App\Http\Controllers\Translate
 */
class SynonymController extends Controller
{

    public function show(int $id): JsonResponse
    {

    }

    public function getByWord(int $id): JsonResponse
    {
        return $this->execute(new GetSynonymsQuery($id));
    }

    public function store(CreateSynonymRequest $request): JsonResponse
    {
        return $this->execute(new CreateSynonymCommand($request->toArray()));
    }

    public function destroy(int $id): JsonResponse
    {
        return $this->execute(new DeleteSynonymCommand($id));
    }
}