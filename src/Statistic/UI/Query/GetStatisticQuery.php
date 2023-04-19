<?php


namespace Scandinaver\Statistic\UI\Query;

use Scandinaver\Core\Domain\Contract\QueryInterface;
use Scandinaver\Core\Domain\Attribute\Handler;
use Scandinaver\Core\Domain\FilteringQuery;
use Scandinaver\Core\Infrastructure\RequestParametersComposition;

/**
 * Class GetStatisticQueryQuery
 *
 * @package Scandinaver\Statistic\UI\Query
 */
#[Handler(\Scandinaver\Statistic\Application\Handler\Query\GetStatisticQueryHandler::class)]
class GetStatisticQuery extends FilteringQuery implements QueryInterface
{

    public function __construct(RequestParametersComposition $parameters)
    {
        parent::__construct($parameters);
    }
}