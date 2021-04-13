<?php


namespace Scandinaver\User\Application\Handler\Query;

use Exception;
use League\Fractal\Resource\Item;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\Query;
use Scandinaver\User\Domain\Contract\Query\GetStateHandlerInterface;
use Scandinaver\User\Domain\Services\UserService;
use Scandinaver\User\UI\Query\GetStateQuery;
use Scandinaver\User\UI\Resources\StateTransformer;

/**
 * Class GetStateHandler
 *
 * @package Scandinaver\User\Application\Handler\Query
 */
class GetStateHandler extends AbstractHandler implements GetStateHandlerInterface
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        parent::__construct();

        $this->userService = $userService;
    }

    /**
     * @param  GetStateQuery|Query  $query
     *
     * @throws Exception
     */
    public function handle($query): void
    {
        $stateDTO = $this->userService->getState($query->getUser(), $query->getLanguage());

        $this->resource = new Item($stateDTO, new StateTransformer());

        $this->fractal->parseIncludes([
            'words.active',
            'words.available',
            'words.completed',
            'sentences.active',
            'sentences.available',
            'sentences.completed',
        ]);
    }
} 