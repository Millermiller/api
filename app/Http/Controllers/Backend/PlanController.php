<?php


namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Scandinaver\User\Domain\Model\Plan;
use Scandinaver\User\UI\Command\CreatePlanCommand;
use Scandinaver\User\UI\Command\DeletePlanCommand;
use Scandinaver\User\UI\Command\UpdatePlanCommand;
use Scandinaver\User\UI\Query\PlanQuery;
use Scandinaver\User\UI\Query\PlansQuery;

/**
 * Class PlanController
 *
 * @package App\Http\Controllers\Main\Backend
 */
class PlanController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json($this->queryBus->execute(new PlansQuery()));
    }

    /**TODO: bind model
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        return response()->json($this->queryBus->execute(new PlanQuery($id)));
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $this->commandBus->execute(new CreatePlanCommand($request->toArray()));

        return response()->json(NULL, 201);
    }

    /**
     * @param Request $request
     * @param Plan    $plan
     *
     * @return JsonResponse
     */
    public function update(Request $request, Plan $plan): JsonResponse
    {
        $this->commandBus->execute(new UpdatePlanCommand($plan, $request->toArray()));

        return response()->json(NULL, 201);
    }

    /**
     * @param Plan $plan
     *
     * @return JsonResponse
     */
    public function destroy(Plan $plan): JsonResponse
    {
        $this->commandBus->execute(new DeletePlanCommand($plan));

        return response()->json(NULL, 204);
    }
}