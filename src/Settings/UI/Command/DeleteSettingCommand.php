<?php


namespace Scandinaver\Settings\UI\Command;

use Scandinaver\Core\Domain\Attribute\Command;
use Scandinaver\Core\Domain\Contract\CommandInterface;
use Scandinaver\Core\Domain\DTO;
use Scandinaver\Settings\Application\Handler\Command\DeleteSettingCommandHandler;

/**
 * Class DeleteSettingCommand
 *
 * @package Scandinaver\Settings\UI\Command
 */
#[Command(DeleteSettingCommandHandler::class)]
class DeleteSettingCommand implements CommandInterface
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