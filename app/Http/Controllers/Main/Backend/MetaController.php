<?php


namespace App\Http\Controllers\Main\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use ReflectionException;
use Scandinaver\Common\Application\Commands\CreateMetaCommand;
use Scandinaver\Common\Application\Commands\DeleteMetaCommand;
use Scandinaver\Common\Application\Commands\UpdateMetaCommand;
use Scandinaver\Common\Application\Query\MetaQuery;
use Scandinaver\Common\Application\Query\MetasQuery;

/**
 * Class SeoController
 *
 * @package App\Http\Controllers\Main\Backend
 */
class MetaController extends Controller
{
    /**
     * @return JsonResponse
     * @throws ReflectionException
     */
    public function index(): JsonResponse
    {
        return response()->json($this->queryBus->execute(new MetasQuery()));
    }

    /**TODO: bind model
     *
     * @param int $id
     *
     * @return JsonResponse
     * @throws ReflectionException
     */
    public function show($id): JsonResponse
    {
        return response()->json($this->queryBus->execute(new MetaQuery($id)));
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     * @throws ReflectionException
     */
    public function store(Request $request): JsonResponse
    {
        $this->commandBus->execute(new CreateMetaCommand($request->toArray()));

        return response()->json(null, 201);
    }

    /**
     * @param Request $request
     * @param Meta    $meta
     *
     * @return JsonResponse
     * @throws ReflectionException
     */
    public function update(Request $request, Meta $meta): JsonResponse
    {
        $this->commandBus->execute(new UpdateMetaCommand($meta, $request->toArray()));

        return response()->json(null, 201);
    }

    /**
     * @return JsonResponse
     * @throws ReflectionException
     */
    public function destroy(Meta $meta): JsonResponse
    {
        $this->commandBus->execute(new DeleteMetaCommand($meta));

        return response()->json(null, 204);
    }
}