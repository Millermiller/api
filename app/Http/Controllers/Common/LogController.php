<?php


namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use Gate;
use Illuminate\Http\JsonResponse;
use Scandinaver\Common\UI\Command\DeleteLogCommand;
use Scandinaver\Common\UI\Query\LogQuery;
use Scandinaver\Common\UI\Query\LogsQuery;

/**
 * Class LogController
 *
 * @package App\Http\Controllers\Main\Backend
 */
class LogController extends Controller
{
    public function index(): JsonResponse
    {
        Gate::authorize('view-logs');

        return $this->execute(new LogsQuery());
    }

    public function show($id): JsonResponse
    {
        Gate::authorize('show-log', $id);

        return $this->execute(new LogQuery($id));
    }

    public function destroy($id): JsonResponse
    {
        Gate::authorize('delete-log', $id);

        return $this->execute(new DeleteLogCommand($id), JsonResponse::HTTP_NO_CONTENT);
    }
}