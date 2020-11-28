<?php


namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Scandinaver\Shared\{CommandBus, Contract\Command, Contract\Query, QueryBus};

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
        $this->queryBus = $queryBus;
    }

    protected function execute(object $data, int $code = 200): JsonResponse
    {
        if ($data instanceof Query) {
            $bus = $this->queryBus;
        }

        if ($data instanceof Command) {
            $bus = $this->commandBus;
        }

        if (!isset($bus)) {
            throw new \Exception('Bus not Found');
        }

        try {
            return response()->json($bus->execute($data), $code);
        } catch (\Exception $exception) {
            return new JsonResponse($exception->getMessage(), $exception->getCode() === 0 ? 500 : $exception->getCode());
        }
    }
}
