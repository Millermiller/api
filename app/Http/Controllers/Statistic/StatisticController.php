<?php

namespace App\Http\Controllers\Statistic;

use App\Http\Controllers\Controller;
use App\Http\Requests\FilteringRequest;
use Gate;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use JsonMapper_Exception;
use Scandinaver\Statistic\UI\Query\GetStatisticQuery;

/**
 * Class StatisticController
 *
 * @package App\Http\Controllers\Statistic
 */
class StatisticController extends Controller
{
    /**
     * @param  FilteringRequest  $request
     *
     * @return JsonResponse
     * @throws AuthorizationException
     * @throws JsonMapper_Exception
     */
    public function index(FilteringRequest $request): JsonResponse
    {
        // Gate::authorize(Settings::VIEW);

        $params = $request->getRequestParameters();

        return $this->execute(new GetStatisticQuery($params));
    }
}