<?php


namespace Scandinaver\Settings\UI\Command;

use Scandinaver\Core\Domain\Attribute\Command;
use Scandinaver\Core\Domain\Contract\CommandInterface;
use Scandinaver\Core\Domain\DTO;
use Scandinaver\Settings\Application\Handler\Command\SetSettingCommandHandler;

/**
 * Class SetSettingCommand
 *
 * @package Scandinaver\Settings\UI\Command
 */
#[Command(SetSettingCommandHandler::class)]
class SetSettingCommand implements CommandInterface
{

    public function __construct(private int $id, private $value)
    {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getValue(): mixed
    {
        return $this->value;
    }

    public function buildDTO(): DTO
    {
        // TODO: Implement buildDTO() method.
    }
}