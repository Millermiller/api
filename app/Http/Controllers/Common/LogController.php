<?php


namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Http\Requests\FilteringRequest;
use Gate;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use JsonMapper_Exception;
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
     * @param  FilteringRequest  $request
     *
     * @return JsonResponse
     * @throws AuthorizationException|JsonMapper_Exception
     */
    public function index(FilteringRequest $request): JsonResponse
    {
        Gate::authorize(Log::VIEW);

        $params = $request->getRequestParameters();

        return $this->execute(new LogsQuery($params));
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