<?php


namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Scandinaver\Common\Infrastructure\Persistence\Eloquent\Meta;
use Scandinaver\Common\UI\Command\CreateMetaCommand;
use Scandinaver\Common\UI\Command\DeleteMetaCommand;
use Scandinaver\Common\UI\Command\UpdateMetaCommand;
use Scandinaver\Common\UI\Query\MetaQuery;
use Scandinaver\Common\UI\Query\MetasQuery;

/**
 * Class MetaController
 *
 * @package App\Http\Controllers\Main\Backend
 */
class MetaController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json($this->queryBus->execute(new MetasQuery()));
    }

    public function show($id): JsonResponse
    {
        return response()->json($this->queryBus->execute(new MetaQuery($id)));
    }

    public function store(Request $request): JsonResponse
    {
        $this->commandBus->execute(new CreateMetaCommand($request->toArray()));

        return response()->json(NULL, 201);
    }

    public function update(Request $request, Meta $meta): JsonResponse
    {
        $this->commandBus->execute(new UpdateMetaCommand($meta, $request->toArray()));

        return response()->json(NULL, 201);
    }

    public function destroy(Meta $meta): JsonResponse
    {
        $this->commandBus->execute(new DeleteMetaCommand($meta));

        return response()->json(NULL, 204);
    }
}