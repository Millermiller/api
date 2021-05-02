<?php


namespace Scandinaver\User\Application\Handler\Query;

use Exception;
use League\Fractal\Resource\Item;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\CommandInterface;
use Scandinaver\User\Domain\Service\UserService;
use Scandinaver\User\UI\Query\GetStateQuery;
use Scandinaver\User\UI\Resource\StateTransformer;

/**
 * Class GetStateQueryHandler
 *
 * @package Scandinaver\User\Application\Handler\Query
 */
class GetStateQueryHandler extends AbstractHandler
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        parent::__construct();

        $this->userService = $userService;
    }

    /**
     * @param  GetStateQuery|CommandInterface  $query
     *
     * @throws Exception
     */
    public function handle(CommandInterface $query): void
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