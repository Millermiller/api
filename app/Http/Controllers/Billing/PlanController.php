<?php


namespace App\Http\Controllers\Billing;

use App\Http\Controllers\Controller;
use Gate;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Scandinaver\Billing\Domain\Permission\Plan;
use Scandinaver\Billing\UI\Command\CreatePlanCommand;
use Scandinaver\Billing\UI\Command\DeletePlanCommand;
use Scandinaver\Billing\UI\Command\UpdatePlanCommand;
use Scandinaver\Billing\UI\Query\PlanQuery;
use Scandinaver\Billing\UI\Query\PlansQuery;

/**
 * Class PlanController
 *
 * @package App\Http\Controllers\Main\Backend
 */
class PlanController extends Controller
{

    /**
     * @return JsonResponse
     *
     * @throws AuthorizationException
     */
    public function index(): JsonResponse
    {
        Gate::authorize(Plan::VIEW);

        return $this->execute(new PlansQuery());
    }

    /**
     * @param  int  $id
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function show(int $id): JsonResponse
    {
        Gate::authorize(Plan::SHOW);

        return $this->execute(new PlanQuery($id));
    }

    /**
     * @param  Request  $request
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function store(Request $request): JsonResponse
    {
        Gate::authorize(Plan::CREATE);

        return $this->execute(new CreatePlanCommand($request->toArray()), JsonResponse::HTTP_CREATED);
    }

    /**
     * @param  Request  $request
     * @param  int      $id
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function update(Request $request, int $id): JsonResponse
    {
        Gate::authorize(Plan::UPDATE);

        return $this->execute(new UpdatePlanCommand($id, $request->toArray()));
    }

    /**
     * @param  int  $id
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function destroy(int $id): JsonResponse
    {
        Gate::authorize(Plan::DELETE);

        return $this->execute(new DeletePlanCommand($id), JsonResponse::HTTP_NO_CONTENT);
    }
}