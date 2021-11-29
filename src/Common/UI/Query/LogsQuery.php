<?php


namespace Scandinaver\Common\UI\Query;

use Scandinaver\Common\Application\Handler\Query\LogsQueryHandler;
use Scandinaver\Core\Domain\Attribute\Query;
use Scandinaver\Core\Domain\Contract\QueryInterface;
use Scandinaver\Core\Infrastructure\RequestParametersComposition;

/**
 * Class LogsQuery
 *
 * @package Scandinaver\Common\UI\Query
 */
#[Query(LogsQueryHandler::class)]
class LogsQuery implements QueryInterface
{
    public function __construct(private RequestParametersComposition $parameters)
    {
    }

    public function getParameters(): RequestParametersComposition
    {
        return $this->parameters;
    }
}