<?php


namespace App\Http\Controllers;

use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use Scandinaver\Shared\{CommandBus, Contract\BaseCommandInterface};

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

    /**
     * Controller constructor.
     *
     * @param  CommandBus  $commandBus
     */
    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    /**
     * @param  BaseCommandInterface  $command
     * @param  int                   $code
     *
     * @return JsonResponse
     */
    protected function execute(BaseCommandInterface $command, int $code = 200): JsonResponse
    {
        try {
            return response()->json($this->commandBus->execute($command), $code);
        } catch (Exception $exception) {
            return new JsonResponse($exception->getMessage(),
                $exception->getCode() === 0 ? JsonResponse::HTTP_INTERNAL_SERVER_ERROR : $exception->getCode());
        }
    }

}
