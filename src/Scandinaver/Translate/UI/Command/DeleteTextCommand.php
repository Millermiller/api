<?php


namespace Scandinaver\Translate\UI\Command;

use Scandinaver\Shared\Contract\CommandInterface;

/**
 * Class DeleteTextCommand
 *
 * @package Scandinaver\Translate\UI\Command
 *
 * @see     \Scandinaver\Translate\Application\Handler\Command\DeleteTextCommandHandler
 */
class DeleteTextCommand implements CommandInterface
{
    private int $text;

    public function __construct(int $text)
    {
        $this->text = $text;
    }
}