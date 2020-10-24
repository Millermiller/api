<?php


namespace Scandinaver\Translate\UI\Command;

use Scandinaver\Shared\Contract\Command;

/**
 * Class PublishTextCommand
 *
 * @package Scandinaver\Translate\UI\Command
 *
 * @see     \Scandinaver\Translate\Application\Handler\Command\PublishTextHandler
 */
class PublishTextCommand implements Command
{
    private int $text;

    public function __construct(int $text)
    {
        $this->text = $text;
    }
}