<?php


namespace Scandinaver\User\Application\Handler\Query;

use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\BaseCommandInterface;
use Scandinaver\User\UI\Query\PlanQuery;

/**
 * Class PlanQueryHandler
 *
 * @package Scandinaver\User\Application\Handler\Query
 */
class PlanQueryHandler extends AbstractHandler
{

    public function __construct()
    {
        parent::__construct();

    }

    /**
     * @param  PlanQuery|BaseCommandInterface  $query
     *
     * @inheritDoc
     */
    public function handle(BaseCommandInterface $query): void
    {
        // TODO: Implement handle() method.
    }
} 