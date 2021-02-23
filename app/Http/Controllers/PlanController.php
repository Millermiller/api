<?php


namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Scandinaver\Shared\EventBusNotFoundException;
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
     * @throws EventBusNotFoundException
     */
    public function index(): JsonResponse
    {
        return $this->execute(new PlansQuery());
    }

    /**
     * @param $id
     *
     * @return JsonResponse
     * @throws EventBusNotFoundException
     */
    public function show($id): JsonResponse
    {
        return $this->execute(new PlanQuery($id));
    }

    /**
     * @param  Request  $request
     *
     * @return JsonResponse
     * @throws EventBusNotFoundException
     */
    public function store(Request $request): JsonResponse
    {
        return $this->execute(new CreatePlanCommand($request->toArray()), JsonResponse::HTTP_CREATED);
    }

    /**
     * @param  Request  $request
     * @param  Plan     $plan
     *
     * @return JsonResponse
     * @throws EventBusNotFoundException
     */
    public function update(Request $request, Plan $plan): JsonResponse
    {
        return $this->execute(new UpdatePlanCommand($plan, $request->toArray()));
    }

    /**
     * @param  Plan  $plan
     *
     * @return JsonResponse
     * @throws EventBusNotFoundException
     */
    public function destroy(Plan $plan): JsonResponse
    {
        return $this->execute(new DeletePlanCommand($plan), JsonResponse::HTTP_NO_CONTENT);
    }
}