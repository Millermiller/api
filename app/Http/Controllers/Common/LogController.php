<?php


namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use Gate;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Scandinaver\Common\Domain\Permissions\Log;
use Scandinaver\Common\UI\Command\DeleteLogCommand;
use Scandinaver\Common\UI\Query\LogQuery;
use Scandinaver\Common\UI\Query\LogsQuery;
use Scandinaver\Shared\EventBusNotFoundException;

/**
 * Class LogController
 *
 * @package App\Http\Controllers\Main\Backend
 */
class LogController extends Controller
{

    /**
     * @return JsonResponse
     * @throws AuthorizationException
     * @throws EventBusNotFoundException
     */
    public function index(): JsonResponse
    {
        Gate::authorize(Log::VIEW);

        return $this->execute(new LogsQuery());
    }

    /**
     * @param $id
     *
     * @return JsonResponse
     * @throws AuthorizationException
     * @throws EventBusNotFoundException
     */
    public function show($id): JsonResponse
    {
        Gate::authorize(Log::SHOW, $id);

        return $this->execute(new LogQuery($id));
    }

    /**
     * @param $id
     *
     * @return JsonResponse
     * @throws AuthorizationException
     * @throws EventBusNotFoundException
     */
    public function destroy($id): JsonResponse
    {
        Gate::authorize(Log::DELETE, $id);

        return $this->execute(new DeleteLogCommand($id), JsonResponse::HTTP_NO_CONTENT);
    }
}