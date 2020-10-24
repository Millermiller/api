<?php


namespace Scandinaver\Translate\UI\Command;

use Scandinaver\Shared\Contract\Command;

/**
 * Class DeleteSynonymCommand
 *
 * @package Scandinaver\Translate\UI\Command
 *
 * @see     \Scandinaver\Translate\Application\Handler\Command\DeleteSynonymHandler
 */
class DeleteSynonymCommand implements Command
{
    private int $synonym;

    public function __construct(int $synonym)
    {
        $this->synonym = $synonym;
    }
}