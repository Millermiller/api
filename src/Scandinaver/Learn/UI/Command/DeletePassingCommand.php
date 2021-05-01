<?php


namespace Scandinaver\Learn\UI\Command;

use Scandinaver\Shared\Contract\CommandInterface;

/**
 * Class DeletePassingCommand
 *
 * @package Scandinaver\Learn\UI\Command
 *
 * @see     \Scandinaver\Learn\Application\Handler\Command\DeletePassingCommandHandler
 */
class DeletePassingCommand implements CommandInterface
{
    private int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }
}