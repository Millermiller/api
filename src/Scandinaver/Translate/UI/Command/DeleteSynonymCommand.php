<?php


namespace Scandinaver\Translate\UI\Command;

use Scandinaver\Shared\Contract\CommandInterface;
use Scandinaver\Shared\DTO;

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

    public function buildDTO(): DTO
    {
        // TODO: Implement buildDTO() method.
    }
}