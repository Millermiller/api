<?php


namespace App\Http\Controllers\Billing;

use App\Helpers\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\Order\CreateOrderRequest;
use App\Http\Requests\Order\UpdateOrderRequest;
use Gate;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Scandinaver\Billing\Domain\Permission\Order;
use Scandinaver\Billing\UI\Command\CreateOrderCommand;
use Scandinaver\Billing\UI\Command\DeleteOrderCommand;
use Scandinaver\Billing\UI\Command\UpdateOrderCommand;
use Scandinaver\Billing\UI\Query\GetOrderQuery;
use Scandinaver\Billing\UI\Query\GetOrdersQuery;

/**
 * Class OrderController
 *
 * @package App\Http\Controllers
 */
class OrderController extends Controller
{

    /**
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function index(): JsonResponse
    {
        Gate::authorize(Order::VIEW);

        return $this->execute(new GetOrdersQuery());
    }

    /**
     * @param  int  $id
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function show(int $id): JsonResponse
    {
        Gate::authorize(Order::SHOW);

        return $this->execute(new GetOrderQuery($id));
    }

    /**
     * @param  CreateOrderRequest  $request
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function store(CreateOrderRequest $request): JsonResponse
    {
        Gate::authorize(Order::CREATE);

        return $this->execute(new CreateOrderCommand($request->toArray(), Auth::user()));
    }

    /**
     * @param  UpdateOrderRequest  $request
     * @param  int                 $id
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function update(UpdateOrderRequest $request, int $id): JsonResponse
    {
        Gate::authorize(Order::UPDATE, $id);

        return $this->execute(new UpdateOrderCommand($id, $request->toArray()));
    }

    /**
     * @param  int  $id
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function destroy(int $id): JsonResponse
    {
        Gate::authorize(Order::DELETE, $id);

        return $this->execute(new DeleteOrderCommand($id));
    }
}