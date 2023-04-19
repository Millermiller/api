<?php


namespace Scandinaver\User\Application\Handler\Query;

use Exception;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\BaseCommandInterface;
use Scandinaver\User\Domain\Service\UserService;
use Scandinaver\User\UI\Query\UserStateQuery;

/**
 * Class UserStateQueryHandler
 *
 * @package Scandinaver\User\Application\Handler\Query
 */
class UserStateQueryHandler extends AbstractHandler
{

    public function __construct(protected UserService $userService)
    {
        parent::__construct();
    }

    /**
     * @param  UserStateQuery|BaseCommandInterface  $query
     *
     * @throws Exception
     */
    public function handle(BaseCommandInterface|UserStateQuery $query): void
    {
        $stateDTO = $this->userService->getState($query->getUser());
    }
}