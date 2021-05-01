<?php


namespace Scandinaver\Translate\UI\Command;

use Scandinaver\Shared\Contract\CommandInterface;

/**
 * Class PublishTextCommand
 *
 * @package Scandinaver\Translate\UI\Command
 *
 * @see     \Scandinaver\Translate\Application\Handler\Command\PublishTextCommandHandler
 */
class PublishTextCommand implements CommandInterface
{
    private int $text;

    public function __construct(int $text)
    {
        $this->text = $text;
    }
}