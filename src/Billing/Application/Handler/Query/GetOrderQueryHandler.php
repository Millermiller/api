<?php


namespace Scandinaver\Billing\Application\Handler\Query;

use Scandinaver\Core\Domain\Contract\CommandInterface;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Billing\UI\Query\GetOrderQuery;

/**
 * Class GetOrderQueryHandler
 *
 * @package Scandinaver\Billing\Application\Handler\Query
 */
class GetOrderQueryHandler extends AbstractHandler
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param GetOrderQuery|CommandInterface $query
     */
    public function handle($query): void
    {
        // TODO: Implement handle() method.
    }
} 