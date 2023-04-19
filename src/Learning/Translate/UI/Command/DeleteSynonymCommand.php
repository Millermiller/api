<?php


namespace Scandinaver\Learning\Translate\UI\Command;

use Scandinaver\Core\Domain\Attribute\Handler;
use Scandinaver\Core\Domain\Contract\CommandInterface;
use Scandinaver\Core\Domain\DTO;
use Scandinaver\Learning\Translate\Application\Handler\Command\DeleteSynonymCommandHandler;

/**
 * Class DeleteSynonymCommand
 *
 * @package Scandinaver\Learning\Translate\UI\Command
 */
#[Handler(DeleteSynonymCommandHandler::class)]
class DeleteSynonymCommand implements CommandInterface
{

    public function __construct(private int $id)
    {
    }

    public function buildDTO(): DTO
    {
        // TODO: Implement buildDTO() method.
    }

    public function getId(): int
    {
        return $this->id;
    }
}