<?php


namespace Scandinaver\Common\UI\Query;

use Scandinaver\Common\Application\Handler\Query\LogsQueryHandler;
use Scandinaver\Core\Domain\Attribute\Handler;
use Scandinaver\Core\Domain\Contract\QueryInterface;
use Scandinaver\Core\Infrastructure\RequestParametersComposition;

/**
 * Class LogsQuery
 *
 * @package Scandinaver\Common\UI\Query
 */
#[Handler(LogsQueryHandler::class)]
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