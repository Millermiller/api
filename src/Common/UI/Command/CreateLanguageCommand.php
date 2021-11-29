<?php


namespace Scandinaver\Common\UI\Command;

use Scandinaver\Common\Application\Handler\Command\CreateLanguageCommandHandler;
use Scandinaver\Core\Domain\Attribute\Command;
use Scandinaver\Core\Domain\Contract\CommandInterface;
use Scandinaver\Core\Domain\DTO;

/**
 * Class CreateLanguageCommand
 *
 * @package Scandinaver\Common\UI\Command
 */
#[Command(CreateLanguageCommandHandler::class)]
class CreateLanguageCommand implements CommandInterface
{

    public function __construct(private array $data)
    {
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