<?php


namespace App\Http\Controllers\Main\Backend;

use ReflectionException;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Scandinaver\User\Domain\Plan;
use Scandinaver\User\Application\Commands\CreatePlanCommand;
use Scandinaver\User\Application\Commands\DeletePlanCommand;
use Scandinaver\User\Application\Commands\UpdatePlanCommand;
use Scandinaver\User\Application\Query\PlanQuery;
use Scandinaver\User\Application\Query\PlansQuery;

/**
 * Class SeoController
 * @package App\Http\Controllers\Main\Backend
 */
class PlanController extends Controller
{
    /**
     * @return JsonResponse
     * @throws ReflectionException
     */
    public function index(): JsonResponse
    {
        return response()->json($this->queryBus->execute(new PlansQuery()));
    }

    /**TODO: bind model
     * @param int $id
     * @return JsonResponse
     * @throws ReflectionException
     */
    public function show($id): JsonResponse
    {
        return response()->json($this->queryBus->execute(new PlanQuery($id)));
    }

    /**
     * @param  Request $request
     * @return JsonResponse
     * @throws ReflectionException
     */
    public function store(Request $request): JsonResponse
    {
        $this->commandBus->execute(new CreatePlanCommand($request->toArray()));

        return response()->json(null, 201);
    }

    /**
     * @param Request $request
     * @param Plan $plan
     * @return JsonResponse
     * @throws ReflectionException
     */
    public function update(Request $request, Plan $plan): JsonResponse
    {
        $this->commandBus->execute(new UpdatePlanCommand($plan, $request->toArray()));

        return response()->json(null, 201);
    }

    /**
     * @param Plan $plan
     * @return JsonResponse
     * @throws ReflectionException
     */
    public function destroy(Plan $plan): JsonResponse
    {
        $this->commandBus->execute(new DeletePlanCommand($plan));

        return response()->json(null, 204);
    }
}