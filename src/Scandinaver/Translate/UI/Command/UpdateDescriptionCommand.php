<?php


namespace Scandinaver\Translate\UI\Command;

use Scandinaver\Shared\Contract\Command;

/**
 * Class UpdateDescriptionCommand
 *
 * @package Scandinaver\Translate\UI\Command
 *
 * @see     \Scandinaver\Translate\Application\Handler\Command\UpdateDescriptionHandler
 */
class UpdateDescriptionCommand implements Command
{
    private int $text;

    public function __construct(int $text)
    {
        $this->text = $text;
    }
}