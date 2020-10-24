<?php


namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
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
    public function index(): JsonResponse
    {
        return $this->execute(new MetasQuery());
    }

    public function show($id): JsonResponse
    {
        return $this->execute(new MetaQuery($id));
    }

    public function store(Request $request): JsonResponse
    {
        return $this->execute(new CreateMetaCommand($request->toArray()));
    }

    public function update(Request $request, int $meta): JsonResponse
    {
        return $this->execute(new UpdateMetaCommand($meta, $request->toArray()));
    }

    public function destroy(int $meta): JsonResponse
    {
        return $this->execute(new DeleteMetaCommand($meta));
    }
}