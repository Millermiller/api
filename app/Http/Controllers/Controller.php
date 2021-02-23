<?php


namespace App\Http\Controllers;

use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use Scandinaver\Shared\{CommandBus, Contract\Command, Contract\Query, EventBusNotFoundException, QueryBus};

/**
 * Class Controller
 *
 * @package App\Http\Controllers
 */
class Controller extends BaseController
{

    use AuthorizesRequests;
    use DispatchesJobs;
    use ValidatesRequests;

    protected CommandBus $commandBus;

    protected QueryBus $queryBus;

    /**
     * Controller constructor.
     *
     * @param  CommandBus  $commandBus
     * @param  QueryBus    $queryBus
     */
    public function __construct(CommandBus $commandBus, QueryBus $queryBus)
    {
        $this->commandBus = $commandBus;
        $this->queryBus   = $queryBus;
    }

    /**
     * @param  object  $data
     * @param  int     $code
     *
     * @return JsonResponse
     * @throws EventBusNotFoundException
     */
    protected function execute(object $data, int $code = 200): JsonResponse
    {
        if ($data instanceof Query) {
            $bus = $this->queryBus;
        }

        if ($data instanceof Command) {
            $bus = $this->commandBus;
        }

        if (!isset($bus)) {
            throw new EventBusNotFoundException();
        }

        try {
            return response()->json($bus->execute($data), $code);
        } catch (Exception $exception) {
            return new JsonResponse($exception->getMessage(),
                $exception->getCode() === 0 ? JsonResponse::HTTP_INTERNAL_SERVER_ERROR : $exception->getCode());
        }
    }

}
