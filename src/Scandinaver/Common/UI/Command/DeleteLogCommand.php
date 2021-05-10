<?php


namespace Scandinaver\Common\UI\Command;

use Scandinaver\Shared\Contract\CommandInterface;
use Scandinaver\Shared\DTO;

/**
 * Class DeleteLogCommand
 *
 * @package Scandinaver\Common\UI\Command
 *
 * @see     \Scandinaver\Common\Application\Handler\Command\DeleteLogCommandHandler
 */
class DeleteLogCommand implements CommandInterface
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

    public function buildDTO(): DTO
    {
        // TODO: Implement buildDTO() method.
    }
}