<?php


namespace App\Http\Controllers;

use Exception;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use Psr\Log\LoggerInterface;
use Scandinaver\Core\Domain\CommandBus;
use Scandinaver\Core\Domain\Contract\BaseCommandInterface;
use Symfony\Component\HttpFoundation\Response;

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

    private LoggerInterface $logger;

    public function __construct(CommandBus $commandBus, LoggerInterface $logger)
    {
        $this->commandBus = $commandBus;
        $this->logger = $logger;
    }

    protected function execute(BaseCommandInterface $command, int $code = 200): JsonResponse
    {
        try {
            return response()->json($this->commandBus->execute($command), $code);
        } catch (Exception $exception) {
            $this->logger->error($exception->getMessage(), $exception->getTrace());
            return new JsonResponse($exception->getMessage(),
                $exception->getCode() === 0 ? Response::HTTP_INTERNAL_SERVER_ERROR : $exception->getCode());
        }
    }

}
