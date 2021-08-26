<?php


namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use Gate;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Scandinaver\Common\Domain\Permission\Log;
use Scandinaver\Common\UI\Command\DeleteLogCommand;
use Scandinaver\Common\UI\Query\LogQuery;
use Scandinaver\Common\UI\Query\LogsQuery;
use Symfony\Component\HttpFoundation\Response;

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
     */
    public function destroy($id): JsonResponse
    {
        Gate::authorize(Log::DELETE, $id);

        return $this->execute(new DeleteLogCommand($id), Response::HTTP_NO_CONTENT);
    }
}