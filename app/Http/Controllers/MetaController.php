<?php


namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
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

    /**
     * @return JsonResponse
     * @throws Exception
     */
    public function index(): JsonResponse
    {
        return $this->execute(new MetasQuery());
    }

    /**
     * @param $id
     *
     * @return JsonResponse
     * @throws Exception
     */
    public function show($id): JsonResponse
    {
        return $this->execute(new MetaQuery($id));
    }

    /**
     * @param  Request  $request
     *
     * @return JsonResponse
     * @throws Exception
     */
    public function store(Request $request): JsonResponse
    {
        return $this->execute(new CreateMetaCommand($request->toArray()));
    }

    /**
     * @param  Request  $request
     * @param  int      $meta
     *
     * @return JsonResponse
     * @throws Exception
     */
    public function update(Request $request, int $meta): JsonResponse
    {
        return $this->execute(new UpdateMetaCommand($meta, $request->toArray()));
    }

    /**
     * @param  int  $meta
     *
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(int $meta): JsonResponse
    {
        return $this->execute(new DeleteMetaCommand($meta));
    }
}