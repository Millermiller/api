<?php


namespace Scandinaver\Common\UI\Query;

use Scandinaver\Shared\Contract\Query;

/**
 * Class LogQuery
 *
 * @package Scandinaver\Common\UI\Query
 *
 * @see     \Scandinaver\Common\Application\Handler\Query\LogHandler
 */
class LogQuery implements Query
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