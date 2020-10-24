<?php


namespace Scandinaver\Common\UI\Command;

use Scandinaver\Shared\Contract\Command;

/**
 * Class DeleteLogCommand
 *
 * @package Scandinaver\Common\UI\Command
 *
 * @see     \Scandinaver\Common\Application\Handler\Command\DeleteLogHandler
 */
class DeleteLogCommand implements Command
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