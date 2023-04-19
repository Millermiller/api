<?php


namespace Scandinaver\Common\UI\Query;

use Scandinaver\Common\Application\Handler\Query\LogQueryHandler;
use Scandinaver\Core\Domain\Attribute\Handler;
use Scandinaver\Core\Domain\Contract\QueryInterface;

/**
 * Class LogQuery
 *
 * @package Scandinaver\Common\UI\Query
 */
#[Handler(LogQueryHandler::class)]
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