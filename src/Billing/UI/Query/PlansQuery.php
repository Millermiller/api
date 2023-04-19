<?php


namespace Scandinaver\Billing\UI\Query;

use Scandinaver\Billing\Application\Handler\Query\PlansQueryHandler;
use Scandinaver\Core\Domain\Attribute\Handler;
use Scandinaver\Core\Domain\Contract\QueryInterface;

/**
 * Class PlansQuery
 *
 * @package Scandinaver\Billing\UI\Query
 */
#[Handler(PlansQueryHandler::class)]
class PlansQuery implements QueryInterface
{

    public function __construct()
    {
    }
}