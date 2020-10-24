<?php


namespace Scandinaver\User\Application\Handler\Query;

use Scandinaver\User\Domain\Contract\Query\PlanHandlerInterface;
use Scandinaver\User\UI\Query\PlanQuery;

/**
 * Class PlanHandler
 *
 * @package Scandinaver\User\Application\Handler\Query
 */
class PlanHandler implements PlanHandlerInterface
{
    public function __construct()
    {
    }

    /**
     * @param  PlanQuery
     *
     * @inheritDoc
     */
    public function handle($query)
    {
        // TODO: Implement handle() method.
    }
} 