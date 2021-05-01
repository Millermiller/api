<?php


namespace Scandinaver\Translate\UI\Command;

use Scandinaver\Shared\Contract\CommandInterface;

/**
 * Class DeleteSynonymCommand
 *
 * @package Scandinaver\Translate\UI\Command
 *
 * @see     \Scandinaver\Translate\Application\Handler\Command\DeleteSynonymCommandHandler
 */
class DeleteSynonymCommand implements CommandInterface
{
    private int $synonym;

    public function __construct(int $synonym)
    {
        $this->synonym = $synonym;
    }
}