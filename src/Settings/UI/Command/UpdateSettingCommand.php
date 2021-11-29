<?php


namespace Scandinaver\Settings\UI\Command;

use Scandinaver\Core\Domain\Attribute\Command;
use Scandinaver\Core\Domain\Contract\CommandInterface;
use Scandinaver\Core\Domain\DTO;
use Scandinaver\Settings\Application\Handler\Command\UpdateSettingCommandHandler;

/**
 * Class UpdateSettingCommand
 *
 * @package Scandinaver\Settings\UI\Command
 */
#[Command(UpdateSettingCommandHandler::class)]
class UpdateSettingCommand implements CommandInterface
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