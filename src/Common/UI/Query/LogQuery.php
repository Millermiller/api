<?php


namespace Scandinaver\Common\UI\Query;

use Scandinaver\Shared\Contract\QueryInterface;

/**
 * Class LogQuery
 *
 * @package Scandinaver\Common\UI\Query
 *
 * @see     \Scandinaver\Common\Application\Handler\Query\LogHandler
 */
class LogQuery implements QueryInterface
{
    private int $logId;

    public function __construct(int $logId)
    {
        $this->logId = $logId;
    }

    public function getLogId(): int
    {
        return $this->logId;
    }
}