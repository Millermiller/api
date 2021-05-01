<?php


namespace Scandinaver\Translate\UI\Command;

use Scandinaver\Shared\Contract\CommandInterface;

/**
 * Class UpdateDescriptionCommand
 *
 * @package Scandinaver\Translate\UI\Command
 *
 * @see     \Scandinaver\Translate\Application\Handler\Command\UpdateDescriptionCommandHandler
 */
class UpdateDescriptionCommand implements CommandInterface
{
    private int $text;

    public function __construct(int $text)
    {
        $this->text = $text;
    }
}