<?php


namespace Scandinaver\Common\UI\Query;

use Scandinaver\Common\Application\Handler\Query\LogQueryHandler;
use Scandinaver\Core\Domain\Attribute\Query;
use Scandinaver\Core\Domain\Contract\QueryInterface;

/**
 * Class LogQuery
 *
 * @package Scandinaver\Common\UI\Query
 */
#[Query(LogQueryHandler::class)]
class LogQuery implements QueryInterface
{

    public function __construct(private int $logId)
    {
    }

    public function getLogId(): int
    {
        return $this->logId;
    }
}