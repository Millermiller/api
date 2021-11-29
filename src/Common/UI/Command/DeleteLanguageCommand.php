<?php


namespace Scandinaver\Common\UI\Command;

use Scandinaver\Common\Application\Handler\Command\DeleteLanguageCommandHandler;
use Scandinaver\Core\Domain\Attribute\Command;
use Scandinaver\Core\Domain\Contract\CommandInterface;
use Scandinaver\Core\Domain\DTO;

/**
 * Class DeleteLanguageCommand
 *
 * @package Scandinaver\Common\UI\Command
 */
#[Command(DeleteLanguageCommandHandler::class)]
class DeleteLanguageCommand implements CommandInterface
{

    public function __construct(private int $id)
    {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function buildDTO(): DTO
    {
        // TODO: Implement buildDTO() method.
    }
}