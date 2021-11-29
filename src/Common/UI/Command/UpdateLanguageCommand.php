<?php


namespace Scandinaver\Common\UI\Command;

use Scandinaver\Common\Application\Handler\Command\UpdateLanguageCommandHandler;
use Scandinaver\Core\Domain\Attribute\Command;
use Scandinaver\Core\Domain\Contract\CommandInterface;
use Scandinaver\Core\Domain\DTO;

/**
 * Class UpdateLanguageCommand
 *
 * @package Scandinaver\Common\UI\Command
 */
#[Command(UpdateLanguageCommandHandler::class)]
class UpdateLanguageCommand implements CommandInterface
{

    public function __construct(private int $id, private array $data)
    {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function buildDTO(): DTO
    {
        // TODO: Implement buildDTO() method.
    }
}