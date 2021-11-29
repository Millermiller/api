<?php


namespace Scandinaver\Learning\Translate\UI\Command;

use Scandinaver\Core\Domain\Attribute\Command;
use Scandinaver\Core\Domain\Contract\CommandInterface;
use Scandinaver\Learning\Translate\Application\Handler\Command\CreateSynonymCommandHandler;
use Scandinaver\Learning\Translate\Domain\DTO\SynonymDTO;

/**
 * Class CreateSynonymCommand
 *
 * @package Scandinaver\Learning\Translate\UI\Command
 */
#[Command(CreateSynonymCommandHandler::class)]
class CreateSynonymCommand implements CommandInterface
{

    public function __construct(private array $data)
    {
    }

    public function buildDTO(): SynonymDTO
    {
        return SynonymDTO::fromArray($this->data);
    }
}