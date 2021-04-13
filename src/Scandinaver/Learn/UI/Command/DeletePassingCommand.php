<?php


namespace Scandinaver\Learn\UI\Command;

use Scandinaver\Shared\Contract\Command;

/**
 * Class DeletePassingCommand
 *
 * @package Scandinaver\Learn\UI\Command
 *
 * @see     \Scandinaver\Learn\Application\Handler\Command\DeletePassingHandler
 */
class DeletePassingCommand implements Command
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